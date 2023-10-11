try {
var multiselectinterfaces = ["Business Searching Interface",
"EBSCO Learning Interface",
"EBSCOhost Research Databases",
"Explora - Australia/New Zealand",
"Explora Canada",
"Explora Primary - Australia/New Zealand",
"Explora Primary - Canada",
"Explora Primary Schools",
"Explora Public Libraries",
"Explora Secondary Schools",
"Nursing Reference Center",
"Nursing Reference Center Plus",
"Patient Education Reference Center",
"Social Work Reference Center"];
        $(document).ready(function () {
			$("#txtInterface").on('change', function() {
    var myInterface = $("option:selected", this).text();
	if  (multiselectinterfaces.indexOf(myInterface) > -1){
		$("#dbfilter").show();
	} else {
		$("#dbfilter").hide();
	}
});
			
$('#chkfilter').on('keyup', function() {
    var query = this.value;
	query = query.toUpperCase();

    $('span[data-class="databaseDisplayName"]').each(function(i, elem, dbn) {
		var elem = $(this).text();
		elem = elem.toUpperCase();
		var dbn = $(this).parent().attr("for");
		dbn = dbn.toUpperCase();
		
          if (elem.indexOf(query) != -1 || dbn.indexOf(query) != -1) {
              $(this).closest('li').show();
          }else{
              $(this).closest('li').hide();
          }
    });
});

        });
} catch (err) {
    console.info(err);
}
