/*jslint eqeq: true, forin: true */
var baseUrl = {
	logos: 'http://support.ebscohost.com/images/logos/'
};

var ep = {};


//You can now create a bindingProvider that uses something different than data-bind attributes
ko.customBindingProvider = function (bindingObject) {
	this.bindingObject = bindingObject;

	//determine if an element has any bindings
	this.nodeHasBindings = function (node) {
		return node.getAttribute ? node.getAttribute("data-class") : false;
	};

	//return the bindings given a node and the bindingContext
	this.getBindings = function (node, bindingContext) {
		var result = {},
			classes = node.getAttribute("data-class");
		if (classes) {
			classes = classes.split(' ');
			//evaluate each class, build a single object to return
			for (var i = 0, j = classes.length; i < j; i++) {
				var bindingAccessor = this.bindingObject[classes[i]];
				if (bindingAccessor) {
					var binding = typeof bindingAccessor === "function" ? bindingAccessor.call(bindingContext.$data) : bindingAccessor;
					ko.utils.extend(result, binding);
				}
			}
		}

		return result;
	};
};

var viewModel;

var createType = function (defaults) {
	var Type = function (overrides) {
		if (overrides) {
			for (var prop in overrides) {
				this[prop] = overrides[prop];
			}
		}

		return this;
	};

	Type.prototype = defaults;

	return function (overrides) {
		return new Type(overrides);
	};
};

var limiter = function (type, displayName, value, alwaysHide, finalDisplayName) {
	return {
		type: ko.observable(type),
		displayName: displayName,
		finalDisplayName: finalDisplayName,
		value: value,
		state: ko.observable(false),
		visible: ko.observable(true),
		alwaysHide: alwaysHide,

		capitaliseFirstLetter: function (string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}
	};
};

var authMethodMulti = function (type, displayName) {
	return {
		type: ko.observable(type),
		displayName: displayName,
		state: ko.observable(false)
	};
};

var discipline = function (code, displayName) {
	return {
		code: code,
		displayName: displayName,
		visible: ko.observable(false),
		isDefaultSelected: ko.observable('false'),

		capitaliseFirstLetter: function (string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}
	};
};

var database = function (name, displayName, designs, baseUrl) {
	return {
		name: name,
		displayName: displayName,
		state: ko.observable(false),
		designs: (designs) ? designs : null,
		baseUrl: (baseUrl) ? baseUrl : null,

		// method to build url string for this database
		buildUrl: function () {
			return viewModel.buildUrl(this);
		}
	};
};


var searchMode = function (name, text) {
	return {
		name: name,
		text: text
	};
};

var language = function (name, text) {
	return {
		name: name,
		text: text
	};
};


function ViewModel(configJson) {
	var self = this,
		I = configJson.interfaces;

	self.availableOptions = configJson.availableOptions;
	self.links = configJson.links;

	configJson.interfaces['ehost-live'].language = ko.observable(self.availableOptions.languages[6]);
	configJson.interfaces['eds-live'].language = ko.observable(self.availableOptions.languages[6]);

	// function to sort databases by display name
	var databaseSort = function (a, b) {
		var nameA = a.displayName.toLowerCase(),
		    nameB = b.displayName.toLowerCase();
		if (nameA < nameB) {
			return -1;
		}
		if (nameA > nameB) {
			return 1;
		}
		return 0;
	};

	// Sort list of databases in alphabetical order
	$.each(I, function () {
		var databases = this.databases,
			singleSelect = databases.singleSelect,
			multiSelect = databases.multiSelect;

		singleSelect.sort(databaseSort);
		multiSelect.sort(databaseSort);
	});

	function createInterface(interfaceName, noDefaultLimiters) {
		// set properties shared by all interfaces here.
		// Can be overridden by individual interfaces.
		var objToExtend = {
			chooseDatabaseAccess: [
				{ type: 'databases', displayName: 'Databases', state: ko.observable(true) },
				{ type: 'profile', displayName: 'Profile', state: ko.observable(false) }
			],
			searchMode: ko.observable('bool'),
			showPubLimiters: ko.observable(false),
			keywords: ko.observable(''),

			// Step 2 in original SBB
			proxyPrefix: ko.observable(''),
			authMethods: {
				multiSelectable: [
					authMethodMulti('cookie', 'Cookie'),
					authMethodMulti('ip', 'IP Address')
				],
				singleSelect: [
					{ type: 'guest', text: 'Guest Access', disable: true },
					{ type: 'user', text: 'Personal User' },
					{ type: 'uid', text: 'User ID/Password' },
					{ type: 'url', text: 'Referring URL' },
					{ type: 'athens', text: 'Athens' },
					{ type: 'shib', text: 'Shibboleth' },
					{ type: 'custuid', text: 'Patron ID' },
					{ type: 'cpid', text: 'Patterned ID' }
				]
			},
			custId: ko.observable(''), // not the same customer id in the profile section - should it be?
			https: ko.observable(false),
			// Step 3 in original SBB
			//selectedDesign: ko.observable(),
			// Step 4 in original SBB
			layout: {
				title: ko.observable('Research databases'),
				logo: ko.observable('http://supportforms.epnet.com/eit/images/ebscohost.gif'),
				height: ko.observable(66),
				width: ko.observable(375),
				openNewWindow: ko.observable(true),
				leftPaddingMinus: 225
			},
			// for building url
			searchType: 1,
			noDatabasesInUrl: false
		};
		
		if (!noDefaultLimiters) {
			objToExtend.limiters = [
				limiter('fullText', 'Full Text', 'FT'),
				limiter('peerReviewed', 'Scholarly (Peer Reviewed) Journals', 'RV')
			];
		}

		return createType()($.extend(true, objToExtend, I[interfaceName]));
	}


	self.selectedInterface = null;
	self.interfaces = null;
	self.singleSelectDatabase = ko.observable();
	self.singleSelectDatabaseName = ko.observable();

	self.ehisDatabase = {
		displayName: ko.observable(),
		code: ko.observable()
	};

	self.databaseGroupList = ko.observableArray();
	self.databaseGroup = {
		displayName: ko.observable(),
		code: ko.observable()
	};

	self.profile = {
		customerId: ko.observable(),
		groupId: ko.observable(),
		profileId: ko.observable()
	};

	self.authMethodSingle = ko.observable();

	self.currentDesignSet = ko.observable();
	self.selectedDesign = ko.observable();
	self.logo = ko.observable();

	self.getDesignUrl = function (selectedDesign) {
		var selectedInterface = viewModel.selectedInterface,
			singleSelectDatabase = viewModel.singleSelectDatabaseComputed(),
			baseUrl = selectedInterface().baseUrl,
			baseUrl = ($('#chkSSL').is(':checked')) ? baseUrl.replace('http://','https://') : baseUrl;

		if (!selectedDesign) {
			selectedDesign = self.selectedDesign();
		}

		return (baseUrl) ?
			baseUrl + selectedDesign
			: singleSelectDatabase().baseUrl + selectedDesign;
	};

	self.url = '';

	self.getInterfaces = function (user, password) {
		// get interfaces returned from server after login

		var interfaceNames = [
			'ehost-live',
			'eli-live',
			'eds-live',
			'edspub-live',
			'eon-live',
			'pov-aus',
			'brc-live',
			'bbs-live',
			'bsi-live',
			'pov-can',
			'ccc-live',
			'ccw-live',
			'cwi-live',
			'chc-live',
			'clw-live',
			'ell-live',
			'hrc-live',
			'hcrc-live',
			'hirc-live',
			'srck5-live',
			'lirc-live',
			'lrc-live',
			'novelist-live',
			'nrc-live',
			'nup-live',
			'perc-live',
			'pov-live',
			'rrc-live',
			'scirc-live',
			'sas-live',
			'sbrc-live',
			'serrc-live',
			'swrc-live',
			'slrc-live',
			'src-live',
			'swi-live',
			'dme-live'
		];

		self.beforeSortInterface = null;


		self.interfaces = (function () {
			var interfaces = [];
			$(interfaceNames).each(function (idx, item) {
				var theInterface = createInterface(item, (item === 'edspub-live' || item === 'eon-live'));
				interfaces.push(theInterface);
			});

			self.beforeSortInterface = interfaces[0];

			interfaces.sort(function (a, b) {
				// Unwrap observables to get interfaces to sort
				return (a.displayName.toLowerCase() > b.displayName.toLowerCase()) ? 1 : -1;
			});

			return interfaces;
		})();

		//self.selectedInterface = ko.observable(createInterface(interfaceNames[0]));
		self.selectedInterface = ko.observable(self.beforeSortInterface);

		self.selectedDatabaseAccessType = ko.observable(self.selectedInterface().chooseDatabaseAccess[0].type);

		var findDatabase = function (name) {
			var database;
			$.each(self.selectedInterface().databases.singleSelect, function () {
				if (this.name === name) {
					database = this;
				}
			});
			return database;
		};

		self.singleSelectDatabaseComputed = ko.computed({
			read: function () {
				return self.singleSelectDatabase;
			},
			write: function (value) {
				self.singleSelectDatabase(findDatabase(value));
			}
		});

		self.currentDesignSetComputed = ko.computed({
			read: function () {
				var selectedInterface = self.selectedInterface,
					designs = selectedInterface().designs,
					returnDesigns;

				if (designs) {
					returnDesigns = designs;
				}
				else {
					if (self.singleSelectDatabaseComputed()()) {
						returnDesigns = self.singleSelectDatabaseComputed()().designs;
					}
					else {
						self.singleSelectDatabase(selectedInterface().databases.singleSelect[0]);
						returnDesigns = self.singleSelectDatabaseComputed()().designs;
					}
				}

				return returnDesigns;
			}
		});

		self.singleSelectDatabaseNameComputed = ko.computed({
			read: function () {
				return self.singleSelectDatabaseName();
			},

			write: function (value) {
				self.singleSelectDatabaseName(value);
				// also write to singleSelectDatabase
				self.singleSelectDatabaseComputed(value);

				// update selected design
				self.selectedDesignComputed(self.currentDesignSetComputed()[0]);
			}
		});

		self.selectedDesignBaseUrl = ko.computed({
			read: function () {
				var selectedInterface = self.selectedInterface,
					selectedDesign = self.selectedDesign,
					singleSelectDatabase = self.singleSelectDatabaseComputed(),
					baseUrl = selectedInterface().baseUrl;

				return (baseUrl) ?
					baseUrl + selectedDesign
					: singleSelectDatabase().baseUrl + selectedDesign();
			}
		});

		self.selectedDesignComputed = ko.computed({
			read: function () {
				self.selectedDesign();
			},

			write: function (value) {
				self.logoComputed(value);

				self.selectedDesign(value);
			}
		});

		self.selectedInterfaceComputed = ko.computed({
			read: function () {
				/*				var selectedInterface = self.selectedInterface,
				databases = selectedInterface().databases,
				singleSelect = databases.singleSelect,
				designs = selectedInterface().designs;

				self.singleSelectDatabaseNameComputed((singleSelect.length > 0) ?
				singleSelect[0].name
				: null);

				selectedInterface().selectedDesign(self.currentDesignSetComputed()[0]);*/

				return self.selectedInterface();
			},

			write: function (value) {
				var selectedInterface = self.selectedInterface,
						databases = selectedInterface().databases,
						singleSelect = databases.singleSelect;

				self.singleSelectDatabaseNameComputed((singleSelect.length > 0) ?
						singleSelect[0].name
						: null);

				self.selectedDesignComputed(self.currentDesignSetComputed()[0]);

				self.selectedInterface(value);
			}
		});

		self.logoComputed = ko.computed({
			read: function () {
				return self.logo();
			},

			write: function (value) {
				self.logo(self.getDesignUrl(value));
			}
		});

	};

	self.onDropDown = function () {
		var selectedInterface = self.selectedInterface,
						databases = selectedInterface().databases,
						singleSelect = databases.singleSelect;

		self.singleSelectDatabaseNameComputed((singleSelect.length > 0) ?
						singleSelect[0].name
						: null);

		self.selectedDesignComputed(self.currentDesignSetComputed()[0]);

		/*					selectedInterface().layout.logo(
		self.getDesignUrl(self.currentDesignSetComputed()[0])
		);*/

		self.buildSearchBox(true);
	};



	self.buildUrl = function (database) {
		var selectedInterface = self.selectedInterface,
		    databasesString = (database) ? ('&db=' + database.name)
				: (getDatabasesString() + getDBGroupsDatabasesString()),
			proxyInfo = parseProxy(),
			beginning = (proxyInfo.position === 'beginning') ?
				proxyInfo.prefix + getProtocol() + proxyInfo.WAMProxyURL
				: (getProtocol() + proxyInfo.WAMProxyURL + '.' + proxyInfo.prefix),
			interfaceName = (selectedInterface().name === 'edspub-live') ? 'eds-live' : selectedInterface().name;
		
		var url = beginning +
			"/login.aspx?direct=true" +
			'&site=' + interfaceName +
			"&scope=site&type=" +
			selectedInterface().searchType +
			databasesString +
			getProfileString() +
			'&mode=' + selectedInterface().searchMode() +
			//getLimitersString() +
			getLanguageString() +
			getAuthTypeString() +
			getSLLString();

		return url;
	};
	
	var parseProxy = function () {
		var input = self.selectedInterface().proxyPrefix(),
			position,
			prefix,
			WAMProxyURL='://search.ebscohost.com';
			
		if (!input.length) {
			prefix = '';
			position = 'beginning';
		}
		else {
			var matchRightBrace = input.match(/\}/g),
			    matchLeftBrace = input.match(/\{/g);
			
			if(input.indexOf('://0-') > -1)
			{
				WAMProxyURL = '://0-search.ebscohost.com';
			}

			if (matchRightBrace && matchRightBrace.length === 2 && matchLeftBrace && matchLeftBrace.length === 2) {
				prefix = input.match(/\}([^\{]*)/)[1];
				position = 'inbetween';
			}
			else {
				prefix = input;
				position = 'beginning';
			}
		}

		return {
			prefix: prefix,
			position: position,
			WAMProxyURL: WAMProxyURL
		};
	};

	var getProtocol = function () {
		return (self.selectedInterface().https()) ? 'https' : 'http';
	};

	var getDatabasesString = function () {
		var databasesString = '',
			selectedInterface = self.selectedInterface,
			numberDatabasesSelected = self.getNumberDatabases(),
			doNotPlaceinSearchString = selectedInterface().doNotPlaceinSearchString;

		if ((self.selectedDatabaseAccessType() === 'databases' || self.selectedDatabaseAccessType() === 'profile') &&
			( !selectedInterface().chooseDatabases || (selectedInterface().chooseDatabases && !selectedInterface().chooseDatabases()) || !selectedInterface().noDatabasesInUrl) &&
			( selectedInterface().name !== 'ehost-live' || (!selectedInterface().chooseDatabases() || (numberDatabasesSelected < 2 && selectedInterface().name === 'ehost-live') ) ) ) {
			var databases = selectedInterface().databases,
				singleSelectDatabase = viewModel.singleSelectDatabaseNameComputed();
			/*$.each(databases.singleSelect, function () {
				if (this.state()) {
					databasesString += '&db=' + this.name;
				}
			});*/

			if (singleSelectDatabase && !doNotPlaceinSearchString) {
				databasesString += '&db=' + singleSelectDatabase;
			}
			$.each(databases.multiSelect, function () {
				if (this.state()) {
					databasesString += '&db=' + this.name;
				}
			});

			// Add any added ehis databases as well
			if (self.selectedDatabaseAccessType() === 'databases' && selectedInterface().ehisDatabases) {
				$.each(selectedInterface().ehisDatabases(), function () {
					databasesString += '&db=' + this.name;
				});
			}
		}

		return databasesString;
	};

	var getDBGroupsDatabasesString = function () {
		var selectedInterface = self.selectedInterface;
		var groupDatabasesString = '';
		if (self.selectedDatabaseAccessType === 'database-groups' ||
			(!selectedInterface().chooseDatabases || !selectedInterface().noDatabasesInUrl)) {
			$.each(self.databaseGroupList(), function () {
				groupDatabasesString += '&dbgroup=' + this.name;
			});
		}

		return groupDatabasesString;
	};

	var getProfileString = function () {
		var profileString = '',
			profile = self.profile;
		if (self.selectedDatabaseAccessType() === 'profile') {
			profileString = '&custid=' + profile.customerId() +
			'&groupid=' + profile.groupId() +
			'&profid=' + profile.profileId();
		}

		return profileString;
	};

	var getLimitersString = function () {
		var buildLimiterString = function (cli, clv, count) {
			return '&cli' + count + '=' + cli +
				'&clv' + count + '=' + clv;
		};

		var selectedInterface = self.selectedInterface,
			limiters = selectedInterface().limiters,
			pubLimiters = selectedInterface().pubLimiters,
			disciplines = selectedInterface().disciplines,
			limitersString = '',
			limiterCount = 0;

		/*if (limiters) {
		$.each(limiters, function () {
		if (this.state()) {
		limitersString += buildLimiterString(this.value, 'Y', limiterCount);
		limiterCount++;
		}
		});
		}*/
		if (pubLimiters) {
			var pubLimiterValues = [];
			$.each(pubLimiters, function () {
				if (this.state()) {
					pubLimiterValues.push(this.value);
				}
			});

			if (pubLimiterValues.length) {
				limitersString += '&cli' + limiterCount + '=PT82&clv' +
				limiterCount + '=' + (pubLimiterValues.join('%7e'));
				limiterCount++;
			}
		}
		if (disciplines) {
			$.each(disciplines, function () {
				if (this.isDefaultSelected()) {
					limitersString += '&cli' + limiterCount + '=' + // TODO add ID
					'&clv' + limiterCount + '=LO+system.dis-' + this.code + '%7e';
					limiterCount++;
				}
			});

			limitersString.replace(/%7e$/, '');
		}

		return limitersString;
	};

	var getLanguageString = function () {
		var language = self.selectedInterface().language,
			languageString = '';
		if (language) {
			languageString += '&lang=' + language().name;
		}

		return languageString;
	};

	var getAuthTypeString = function () {
		var authString = '',
			authMethods = self.selectedInterface().authMethods,
			selectedMethods = [],
			methodsString = '',
			custId = self.selectedInterface().custId();

		$.each(authMethods.multiSelectable, function () {
			if (this.state()) {
				selectedMethods.push(this.type());
			}
		});

		if (self.authMethodSingle()) {
			selectedMethods.push(self.authMethodSingle());
		}

		// build the string
		for (var i = 0, length = selectedMethods.length; i < length - 1; i++) {
			var method = selectedMethods[i];
			methodsString += method + ',';
		}

		// add last method to string without appending semicolon
		var lastMethod = selectedMethods.pop();
		if (lastMethod) {
			methodsString += lastMethod;
		}

		// currently adds custid here regards if custid already given in profile section
		if (custId) {
			methodsString += '&custid=' + custId;
		}

		return (methodsString.length) ? '&authtype=' + methodsString
			: '';
	};

	var getSLLString = function () {
		var sllString = '';
		if (self.selectedInterface().https()) {
			sllString = '&ssl=Y';
		}
		return sllString;
	};

	self.buildSearchBox = function (preview) {
		// determine which limiters are selected in order to check them in template
		checkLimiters();

		var template = $('#limitersTemplate').render(self);

		// Adding script tag here because cannot have in html template or will end
		// containing script tag prematurely.
		var templateStart;

		if (!preview) {
			/*
			 *	create templateStart with the src="" reference to the remote JS, for the user to copy/paste
			*/
			templateStart = '<!-- EBSCOhost Custom Search Box Begins -->\n' +
		'<script src="' + getCurrentPath() + 'scripts/ebscohostsearch.js' + '" type="text/javascript"></script>\n';
			$('#memoCode').val(templateStart + $.trim(template));
		}
		else {
			/*
			 *	Preview mode: we keep a cached copy of the code and will inline it from the cache if possible
			*/
			templateStart = '<!-- EBSCOhost Custom Search Box Begins -->\n' +'<script>';
			if (ep.ebscohostsearchJS) {	// yes, it's cached
				templateStart += ep.ebscohostsearchJS;	// finish the templateStart with the raw JS inlined
				templateStart += '</script>\n';
				$('#testDrivePreview').html(templateStart + $.trim(template));
			} else {	// not cached, gotta fetch it
				$.ajax({
					url: './scripts/ebscohostsearch.js',
					success: function (response) {
						templateStart += response;	//  finish the templateStart with the raw JS inlined
						templateStart += '</script>\n';

						$('#testDrivePreview').html(templateStart + $.trim(template));
						ep.ebscohostsearchJS = response;
					}
				});
			}
		}

	};

	var getCurrentPath = function () {
		var secureAuthProtocol = $('#chkSSL').is(':checked') ? 'https:' : 'http:',
		    location = window.location,
		    protocol = location.protocol,
		    host = location.host,
			path = location.pathname,
			currentDirectory = (function () {
				var retstr = path.substring(0, path.lastIndexOf('/'));
				if (retstr.length) {
					retstr = retstr.substring(path.indexOf('/')+1, retstr.length);
				}
				return retstr;
			})();

		return secureAuthProtocol + '//' + host + '/' + (currentDirectory.length ? (currentDirectory + '/') : '');
	};
	
	self.limiters = {
		fullText: false,
		peerReviewed: false,
		catalogOnly: false,
		libraryCollection: false
	};
	
	var checkLimiters = function () {
		var limiters = self.selectedInterface().limiters;
		
		if (limiters) {
			$.each(limiters, function () {
				var state = this.state();
				switch(this.type()) {
					case 'fullText': self.limiters.fullText = state;
						break;
					case 'peerReviewed': self.limiters.peerReviewed = state;
						break;
					case 'libraryCollection': self.limiters.libraryCollection = state;
						break;
					case 'catalogOnly': self.limiters.catalogOnly = state;
						break;
				}
			});
		}
	};
	
	// additional methods to output values for generated search box html
	self.getSearchSource = function () {
		var searchSource = 'db';
		if (!( ((self.selectedInterface().chooseDatabases && self.selectedInterface().chooseDatabases()) &&
			self.getNumberDatabases() > 1) ||
			self.selectedInterface().name === 'eds-live' ||
			self.selectedInterface().name === 'edspub-live')) {
			 searchSource = 'url';
		}
		
		return searchSource;
	};
	
	self.getSearchMode = function () {
		switch(self.selectedInterface().searchMode()) {
			case 'bool' : return '+';
			case 'and': return '+AND+';
			case 'or': return '+OR+';
		}
	};
	
	self.areLimitersSelected = function () {
		var isSelected = false;
		//US6415: For Dynamed & Flipster making visible false
		if(self.selectedInterface().name === 'dme-live'|| self.selectedInterface().name === 'eon-live')
			return false;
		else
		{
			var limiters = self.selectedInterface().limiters;

			if (limiters) {
				$.each(limiters, function () {
					if (this.visible() === true && !this.alwaysHide) {
						isSelected = true;
					}
				});
			}
			return isSelected;
		}
	};
	
	self.getNumberDatabases = function () {
		return $('#searchdatabases input:checked').length;
	};

	self.getNumberVisibleDisciplines = function () {
		return $('#disciplinesContainer > tbody tr input[type="checkbox"]:checked').length;

	};

	// Return boolean indicating if at least one visible discipline is selected
	self.visibleDisciplineSelected = function () {
		var isVisableAndSelected = false;
		$.each(self.selectedInterface().disciplines, function () {
			if (this.visible() && this.isDefaultSelected() === 'true') {
				isVisableAndSelected = true;
				return false;
			}
		});

		return isVisableAndSelected;
	};
	
	
	self.displayError = function (errorMessage) {
		$('#memoCode').val(errorMessage);
	};

}

function swapImage() {
	var i,
	    j = 0,
	    x,
	    a = arguments;

	document.sr = [];
	for (i = 0; i < (a.length - 2); i += 3) {
		if ((x = findObj(a[i])) !== null) {
			document.sr[j++] = x;
			if (!x.oSrc) {
				x.oSrc = x.src;
			}
			x.src = a[i + 2];
		}
	}
}

function swapImgRestore() {
	var i,
	    x,
	    a = document.sr;

	for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) {
		x.src = x.oSrc;
	}
}

// Get json config file
$.ajax({
	url: 'js/config.js',
	cache: false,
	dataType: 'json',
	success: function (configJson) {
		var wrapChecked = function (prop) {
			if (prop) {
				return ko.observable(prop);
			}
		};
		var checkAssignLoop = function (prop, callback) {
			if (prop) {
				var array = [];
				$.each(prop, function (key, value) {
					array.push(callback(key, value));
				});
				return array;
			}
		};



		var languages = configJson.availableOptions.languages;
		configJson.availableOptions.languages = checkAssignLoop(languages, function (key, value) {
			return language(key, value.text);
		});

		// setup models
		$.each(configJson.interfaces, function (key, I) {
			I.name = key;
			//I.language = wrapChecked(I.language);
			if (I.chooseDatabaseAccess) {
				$.each(I.chooseDatabaseAccess, function () {
					this.state = ko.observable(this.state);
				});
			}
			if (I.ehisDatabases) {
				I.ehisDatabases = ko.observableArray();
			}
			I.hasDatabaseGroups = wrapChecked(I.hasDatabaseGroups);
			I.showPubLimiters = wrapChecked(I.showPubLimiters);
			I.chooseDatabases = wrapChecked(I.chooseDatabases);

			I.showSearchBy = wrapChecked(I.showSearchBy);
			I.showCatalogOnly = wrapChecked(I.showCatalogOnly);
			I.showLibraryCollection = wrapChecked(I.showLibraryCollection);
			I.disciplineDisplayType = wrapChecked(I.disciplineDisplayType);
			I.showFullTextLimiter = wrapChecked(I.showFullTextLimiter);
			I.showPeerReviewedLimiter = wrapChecked(I.showPeerReviewedLimiter);

			if (I.baseUrl) {
				I.baseUrl = baseUrl[I.baseUrl];
			}

			if (I.layout && I.layout.title) {
				I.layout.title = ko.observable(I.layout.title);
			}
			
			if (I.layout && I.layout.helpText) {
				I.layout.helpText = ko.observable(I.layout.helpText);
			}
			
			if (I.layout && I.layout.width) {
				I.layout.width = ko.observable(I.layout.width);
			}
			
			if (I.layout && I.layout.leftPadding) {
				I.layout.leftPadding = I.layout.leftPadding;
			}

			I.databases.multiSelect = checkAssignLoop(I.databases.multiSelect, function (key, value) {
				return database(key, value.displayName);
			});

			I.databases.singleSelect = checkAssignLoop(I.databases.singleSelect, function (key, value) {
				return database(key, value.displayName, value.designs, baseUrl[value.baseUrl]);
			});

			I.limiters = checkAssignLoop(I.limiters, function (key, value) {
				return limiter(key, value.displayName, value.value, value.alwaysHide, value.finalDisplayName);
			});

			I.pubLimiters = checkAssignLoop(I.pubLimiters, function (key, value) {
				return limiter(key, value.displayName, value.value);
			});

			I.disciplines = checkAssignLoop(I.disciplines, function (key, value) {
				return discipline(key, value.displayName);
			});
			
			if (I.disciplines) {
				I.disciplines.sort(function (a, b) {
					// Unwrap observables to get interfaces to sort
					return (a.displayName.toLowerCase() > b.displayName.toLowerCase()) ? 1 : -1;
				});
			}

			if (I.authMethods) {
				I.authMethods.multiSelectable = checkAssignLoop(I.authMethods.multiSelectable, function (key, value) {
					return authMethodMulti(key, value.displayName);
				});
			}
		});


		viewModel = new ViewModel(configJson);

		viewModel.getInterfaces('', '');
		viewModel.onDropDown(); // init dropdown

		var bindings = {

			dropdown: function () {
				return {
					options: viewModel.interfaces,
					optionsText: function (item) {
						return item.displayName;
					},
					value: viewModel.selectedInterfaceComputed,
					event: {
						change: viewModel.onDropDown
					}
				};
			},

			languagesContainer: function () {
				return { visible: viewModel.selectedInterface().language };
			},
			languages: function () {
				return {
					options: viewModel.availableOptions.languages,
					optionsText: 'text',
					value: viewModel.selectedInterface().language
				};
			},

			databaseAccessList: function () {
				return { foreach: viewModel.selectedInterface().chooseDatabaseAccess };
			},
			databaseAccessInput: function () {
				return {
					attr: {
						'id': this.type
					},
					value: this.type,
					checked: viewModel.selectedDatabaseAccessType
				};
			},
			databaseAccessLabel: function () {
				return {
					attr: { 'for': this.type }
				};
			},
			databaseAccessText: function () {
				return { text: this.displayName };
			},

			databases: function () {
				return {
					visible: viewModel.selectedDatabaseAccessType() === 'databases' ||
			viewModel.selectedDatabaseAccessType() === 'profile'
				};
			},
			databaseGroups: function () {
				return {
					visible: viewModel.selectedDatabaseAccessType() === 'database-groups'
				};
			},
			profile: function () {
				return {
					visible: viewModel.selectedDatabaseAccessType() === 'profile'
				};
			},

			addDatabaseGroupDisplayName: function () {
				return { value: viewModel.databaseGroup.displayName };
			},
			addDatabaseGroupCode: function () {
				return { value: viewModel.databaseGroup.code };
			},
			addDatabaseGroup: function () {
				return {
					click: function () {
						var databaseGroup = viewModel.databaseGroup,
					newDatabase = database(databaseGroup.code(), databaseGroup.displayName());

						newDatabase.state(true);
						viewModel.databaseGroupList.push(newDatabase);

					}
				};
			},

			profileCustomerId: function () {
				return {
					value: viewModel.profile.customerId
				};
			},
			profileGroupId: function () {
				return {
					value: viewModel.profile.groupId
				};
			},
			profileProfileId: function () {
				return {
					value: viewModel.profile.profileId
				};
			},

			databasesSingleSelect: function () {
				return {
					visible: viewModel.selectedInterface().databases.singleSelect.length,
					foreach: viewModel.selectedInterface().databases.singleSelect
				};
			},
			databaseSingleInput: function () {
				return {
					attr: {
						'id': this.name
					},
					value: this.name,
					checked: viewModel.singleSelectDatabaseNameComputed
					/*
					checked: viewModel.singleSelectDatabase,
					click: function () {
					viewModel.currentDesignSet(
					(selectedInterface().designs) ? selectedInterface().designs
					: this.designs
					);
					return true;
					}
					*/
				};
			},

			databasesMultiSelect: function () {
				return {
					visible: viewModel.selectedInterface().databases.multiSelect.length,
					foreach: viewModel.selectedInterface().databases.multiSelect
				};
			},
			ehisDatabases: function () {
				return {
					foreach: viewModel.selectedInterface().ehisDatabases,
					visible: viewModel.selectedInterface().ehisDatabases && viewModel.selectedInterface().ehisDatabases().length
				};
			},
			databaseGroupList: function () {
				return {
					foreach: viewModel.databaseGroupList,
					visible: viewModel.selectedInterface().hasDatabaseGroups
				};
			},

			databaseInput: function () {
				return {
					attr: {
						'id': this.name
					},
					checked: this.state
				};
			},
			databaseLabel: function () {
				return {
					attr: { 'for': this.name }
				};
			},
			databaseDisplayName: function () {
				return { text: this.displayName };
			},
			databaseName: function () {
				return {
					text: '(' + this.name + ')'
				};
			},

			addEhisDatabaseContainer: function () {
				return { visible: viewModel.selectedInterface().ehisDatabases && viewModel.selectedDatabaseAccessType() === 'databases' };
			},
			addEhisDatabaseDisplayName: function () {
				return { value: viewModel.ehisDatabase.displayName };
			},
			addEhisDatabaseCode: function () {
				return { value: viewModel.ehisDatabase.code };
			},
			addEhisDatabase: function () {
				return {
					click: function () {
						var ehisDatabase = viewModel.ehisDatabase,
					newDatabase = database(ehisDatabase.code(), ehisDatabase.displayName());

						newDatabase.state(true);
						viewModel.selectedInterface().ehisDatabases.push(newDatabase);
					}
				};
			},

			searchModeContainer: function () {
				return { visible: !viewModel.selectedInterface().hideSearchMode };
			},
			searchModes: function () {
				return { foreach: viewModel.availableOptions.searchModes };
			},
			searchModeInput: function () {
				return {
					attr: {
						id: 'searchMode' + this.value,
						value: this.value
					},
					checked: viewModel.selectedInterface().searchMode
				};
			},
			searchModeLabel: function () {
				return {
					attr: { 'for': 'searchMode' + this.value },
					text: this.text
				};
			},

			limitersContainer: function () {
			//US6415: For Dynamed & Flipster making visible false
			var isDynamed = (viewModel.selectedInterface().name === 'dme-live');
			var isFlipster = (viewModel.selectedInterface().name === 'eon-live');						
			if(isDynamed || isFlipster)
				return{ visible:false };
			else
				return { visible: viewModel.selectedInterface().limiters };
			},
			limiters: function () {
				return { foreach: viewModel.selectedInterface().limiters };
			},
			pubLimitersContainer: function () {
				return { visible: viewModel.selectedInterface().pubLimiters };
			},
			pubLimiters: function () {
				return { foreach: viewModel.selectedInterface().pubLimiters };
			},
			limiterInput: function () {
				return {
					attr: { id: this.type },
					checked: this.state
				};
			},
			limiterLabel: function () {
				return {
					attr: { 'for': this.type },
					text: this.displayName
				};
			},

			disciplinesContainer: function () {
				return {
					visible: viewModel.selectedInterface().disciplines
				};
			},
			disciplinesBetaReleaseLink: function () {
				return {
					attr: {
						href: viewModel.links.disciplinesBetaRelease
					}
				};
			},
			disciplinesBody: function () {
				return {
					foreach: viewModel.selectedInterface().disciplines
				};
			},
			disciplineIsEnable: function () {
				return {
					checked: this.visible
				};
			},
			disciplineName: function () {
				return {
					text: this.displayName
				};
			},
			disciplineIsDefaultSelectedOn: function () {
				return {
					attr: {
						id: 'disciplineDefaultSelectedOn' + this.code,
						name: 'disciplineDefaultSelected' + this.code
					},
					value: 'true',
					checked: this.isDefaultSelected
				};
			},
			disciplineIsDefaultSelectedOnLabel: function () {
				return {
					attr: { 'for': 'disciplineDefaultSelectedOn' + this.code }
				};
			},
			disciplineIsDefaultSelectedOff: function () {
				return {
					attr: {
						id: 'disciplineDefaultSelectedOff' + this.code,
						name: 'disciplineDefaultSelected' + this.code
					},
					value: 'false',
					checked: this.isDefaultSelected
				};
			},
			disciplineIsDefaultSelectedOffLabel: function () {
				return {
					attr: { 'for': 'disciplineDefaultSelectedOff' + this.code }
				};
			},

			keywords: function () {
				return { value: viewModel.selectedInterface().keywords };
			},

			// Step 2 in original SBB
			proxyPrefix: function () {
				return { value: viewModel.selectedInterface().proxyPrefix };
			},

			authMethodsMulti: function () {
				return { foreach: viewModel.selectedInterface().authMethods.multiSelectable };
			},
			authMethodsMultiInput: function () {
				return {
					attr: { id: this.type },
					checked: this.state
				};
			},
			authMethodsMultiLabel: function () {
				return {
					attr: { 'for': this.type }
				};
			},
			authMethodsMultiText: function () {
				return {
					text: this.displayName
				};
			},

			authMethodsSingle: function () {
				return { foreach: viewModel.selectedInterface().authMethods.singleSelect };
			},
			authMethodsSingleInput: function () {
				return {
					attr: {
						id: this.type,
						value: this.type
					},
					disable: this.disable,
					checked: viewModel.authMethodSingle
				};
			},
			authMethodsSingleLabel: function () {
				return {
					attr: { 'for': this.type }
				};
			},
			authMethodsSingleText: function () {
				return { text: this.text };
			},

			authCustIdContainer: function () {
				return {
					visible: viewModel.authMethodSingle() === 'custuid' ||
				viewModel.authMethodSingle() === 'cpid'
				};
			},
			authCustId: function () {
				return { value: viewModel.selectedInterface().custId };
			},

			https: function () {
				return { value: viewModel.selectedInterface().https };
			},

			// Step 3 in original SBB
			designs: function () {
				return { foreach: viewModel.currentDesignSetComputed };
			},
			designImage: function () {
				var self = this,
			url = viewModel.getDesignUrl(self),
			getUrl = function () {
				var isEhost = (viewModel.selectedInterface().name === 'ehost-live'),
					isEli = (viewModel.selectedInterface().name === 'eli-live');
				if (isEhost || isEli) {
					switch (url) {
						case (baseUrl.logos + 'ebscohost.gif'):
							return 'img/sbb/PreviewOversized.gif';
						case (baseUrl.logos + 'researchdatabases.gif'):
							return 'img/sbb/PreviewLarge.gif';
					}
				}
				return url;
			};
				return {
					attr: {
						'src': (self.length) ? getUrl() : 'img/sbb/PreviewCustom.gif',
						'class': (viewModel.selectedInterface().name === 'ehost-live') ? 'default-style' : ''
					},
					click: function () {
						var designs = viewModel.currentDesignSetComputed(),
					defaultWidth,
					defaultHeight,
					isEhost = (viewModel.selectedInterface().name === 'ehost-live'),					
					isEli = (viewModel.selectedInterface().name === 'eli-live'),
					//US6415: Adde code to fix image display issue for Publication Finder interface
					isPfi = (viewModel.selectedInterface().name === 'edspub-live');

						viewModel.selectedDesignComputed(this);
						switch (this.toString()) {
							case designs[0]:
								if (isPfi) {
									defaultWidth = 460;
									defaultHeight = 100;
								}
								else if (isEhost || isEli) {
									defaultWidth = 375;
									defaultHeight = 66;
								}
								else {
									defaultWidth = 340;
									defaultHeight = 50;
									
								}
								break;
							case designs[1]:
								if (isPfi) {
									defaultWidth = 510;
									defaultHeight = 100;
								}
								else if (isEhost || isEli) {
									defaultWidth = 300;
									defaultHeight = 66;									
								}
								else {
									defaultWidth = 392;
									defaultHeight = 75;
								}
								break;
							case designs[2]:
								if (isPfi) {
									defaultWidth = 560;
									defaultHeight = 100;
								}
								else if (isEhost || isEli) {									
									defaultWidth = 225;
									defaultHeight = 50;
									
								}
								else {
									defaultWidth = 440;
									defaultHeight = 100;
								}
								break;
						}
						viewModel.selectedInterface().layout.width(defaultWidth);
						viewModel.selectedInterface().layout.height(defaultHeight);

						// update margin of test drive limiter block
						//$('#limiterblock').css('margin-left', default)
					}
				};
			},

			// Step 4 in original SBB
			layoutTitle: function () {
				return {
					value: viewModel.selectedInterface().layout.title,
					valueUpdate: 'keyup'
				};
			},
			layoutLogo: function () {
				return {
					value: viewModel.logo,
					valueUpdate: 'keyup'
				};
			},
			layoutHelpText: function () {
				return {
					value: viewModel.selectedInterface().layout.helpText,
					valueUpdate: 'keyup'
				};
			},
			layoutHelpTextContainer: function () {
				return {
					visible: viewModel.selectedInterface().layout.helpText !== undefined
				};
			},
			layoutHeight: function () {
				return {
					value: viewModel.selectedInterface().layout.height,
					valueUpdate: 'keyup'
				};
			},
			layoutWidth: function () {
				return {
					value: viewModel.selectedInterface().layout.width,
					valueUpdate: 'keyup'
				};
			},
			layoutOpenNewWindow: function () {
				return { checked: viewModel.selectedInterface().layout.openNewWindow };
			},
			layoutShowLimiters: function () {
			//US6415: For Dynamed & Flipster making visible false.
			var isDynamed = (viewModel.selectedInterface().name === 'dme-live');
			var isFlipster = (viewModel.selectedInterface().name === 'eon-live');			
			if(isDynamed || isFlipster)
				return{ visible:false };
			else 
				return { foreach: viewModel.selectedInterface().limiters,visible:true };
			},
			layoutShowLimiterContainer: function () {
				return {
					visible: !this.alwaysHide
				};
			},
			layoutShowLimiterCheckbox: function () {
				return {
					attr: {
						id: 'chkShow' + this.value,
						name: 'chkShow' + this.value
					},
					checked: this.visible
				};
			},
			layoutShowLimiterFirstLabel: function () {
				return {
					text: (this.finalDisplayName || this.displayName) + ' Limiter' + ':'
				};
			},
			layoutShowLimiterSecondLabel: function () {
				return {
					attr: {
						'for': 'chkShow' + this.value
					},
					text: 'Show ' + (this.finalDisplayName || this.displayName) + ' Checkbox Limiter'
				};
			},

			showChooseDatabases: function () {
				return {
					checked: viewModel.selectedInterface().chooseDatabases
				};
			},
			showSearchBy: function () {
				return { checked: viewModel.selectedInterface().showSearchBy };
			},

			disciplineDisplayTypeCheckBox: function () {
				return {
					value: 'checkBox',
					checked: viewModel.selectedInterface().disciplineDisplayType
				};
			},
			disciplineDisplayTypeScrollBox: function () {
				return {
					value: 'scrollBox',
					checked: viewModel.selectedInterface().disciplineDisplayType
				};
			},

			showChooseDatabasesContainer: function () {
				return { visible: viewModel.selectedInterface().chooseDatabases !== undefined };
			},
			showSearchByContainer: function () {
				return { visible: viewModel.selectedInterface().showSearchBy !== undefined };
			},
			showCatalogOnlyContainer: function () {
				return { visible: viewModel.selectedInterface().showCatalogOnly !== undefined };
			},
			showLibraryCollectionContainer: function () {
				return { visible: viewModel.selectedInterface().showLibraryCollection !== undefined };
			},
			disciplineDisplayTypeContainer: function () {
				return { visible: viewModel.selectedInterface().disciplines !== undefined };
			},
			

			buildSearchbox: function () {
				return {
					click: function () {
						var errorMessage = '',
					errorFlag = false;

						var isUrl = function (s) {
							var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
							return regexp.test(s);
						};


						// perform error checking first
						if (viewModel.selectedDatabaseAccessType() === 'databases' && !viewModel.getNumberDatabases()) {
							errorMessage += 'Please select one or more databases.\n';
							errorFlag = true;
						}
						if (viewModel.selectedDatabaseAccessType() === 'database-groups' &&
					!viewModel.databaseGroupList().length) {
							errorMessage += 'Please add one or more database groups.\n';
							errorFlag = true;
						}
						if (viewModel.selectedDatabaseAccessType() === 'profile' &&
					(!viewModel.profile.customerId() ||
					!viewModel.profile.profileId() ||
					!viewModel.profile.groupId())) {
							errorMessage += 'Please enter IDs for all fields in Profiles.\n';
							errorFlag = true;
						}
						if (viewModel.selectedInterface().proxyPrefix().length &&
					!isUrl(viewModel.selectedInterface().proxyPrefix())) {
							errorMessage += 'Please enter a valid proxy URL.\n';
						}
						if ($('#guest:checked').length &&
					(!viewModel.profile.customerId() ||
					!viewModel.profile.profileId() ||
					!viewModel.profile.groupId())) {
							errorMessage += 'Please enter credentials under Profiles if using Guest Access.\n';
							errorFlag = true;
						}
						if ($('#custuid:checked').length && !viewModel.selectedInterface().custId().length) {
							errorMessage += 'Patron ID requires your Cust ID to authenticate.\n';
							errorFlag = true;
						}
						if ($('#cpid:checked').length && !viewModel.selectedInterface().custId().length) {
							errorMessage += 'Patterned ID requires your Cust ID to authenticate.\n';
							errorFlag = true;
						}
						if (viewModel.logo().length &&
					!isUrl(viewModel.logo())) {
							errorMessage += 'Please enter a valid logo URL.\n';
							errorFlag = true;
						}

						if (errorFlag) {
							$('#memoCode').val(errorMessage);
						}
						else {
							var logoURL = viewModel.logo();
							$('#chkSSL').is(':checked') ? viewModel.logo(logoURL.replace('http://','https://')) : viewModel.logo();
							viewModel.buildSearchBox();
						}
					}
				};
			},

			test: function () {
				return {
					/*text: JSON.stringify(ko.toJS(viewModel), null, 2)*/
				};
			}
		};

		//set ko's current bindingProvider equal to our  new binding provider
		ko.bindingProvider.instance = new ko.customBindingProvider(bindings);

		ko.applyBindings(viewModel);

		// Build test drive search box after page load & model is built
		//viewModel.buildSearchBox(true);

		$('#sbbMainContainer > *').not('#testDriveSection').on('click keyup', function (e) {
			var tagName = e.target.tagName;
			if (tagName === 'INPUT' || tagName === 'BUTTON' || tagName === 'IMG') {
				viewModel.buildSearchBox(true);
			}
		});
	}
});