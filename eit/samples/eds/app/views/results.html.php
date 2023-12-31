<?php 
$queryStringUrl = $results['queryString'];
// URL used by facets links
$refineParams = array(
    'refine' => 'y',
    'query'  => $searchTerm,
    'fieldcode' => $fieldCode
);
$refineParams = http_build_query($refineParams);
$refineSearchUrl = "results.php?".$refineParams;
$encodedSearchTerm = http_build_query(array('query'=>$searchTerm));
$encodedHighLigtTerm = http_build_query(array('highlight'=>$searchTerm));
?>
<div id="toptabcontent">
    <div class="topSearchBox">
        <form action="results.php">
    <p>
        <input type="text" name="query" style="width: 350px;" id="lookfor" value="<?php echo $searchTerm ?>"/>  
        <input type="hidden" name="expander" value="fulltext" />
        <?php 
        $selected1 = '';
        $selected2 = '';
        $selected3 = '';
        if($fieldCode == 'keyword'){
            $selected1 = "selected = 'selected'";
        } 
        if($fieldCode == 'AU'){
            $selected2 = "selected = 'selected'";
        }
        if($fieldCode == 'TI'){
            $selected3 = "selected = 'selected'";
        } ?>
        <select name="fieldcode">
        <option id="type-keyword" name="fieldcode" value="keyword" <?php echo $selected1 ?> >Keyword</option>
        <?php if(!empty($Info['search'])){ ?>
        <?php foreach($Info['search'] as $searchField){
              if($searchField['Label']=='Author'){
                  $fieldc= $searchField['Code']; ?>
                  <option id="type-author" name="fieldcode" value="<?php echo $fieldc; ?>"<?php echo $selected2; ?> >Author</option>
        <?php }
              if($searchField['Label']=='Title'){
                  $fieldc = $searchField['Code']; ?>
                  <option id="type-title" name="fieldcode" value="<?php echo $fieldc; ?>"<?php echo $selected3 ?> >Title</option>     
        <?php      }
              } ?>
        <?php } ?>             
        </select>
        <input type="submit" value="Search" />
        
    </p>
    </form>
    </div>
<div class="table">
    <div class="table-row">
        <div class="table-cell">         
            <div><h4>Refine Search</h4></div>
            
<?php if(!empty($results['appliedFacets'])||!empty($results['appliedLimiters'])||!empty($results['appliedExpanders'])){ ?>
<div class="filters">
    <strong>Remove Facets</strong>
    <ul class="filters">
<!-- applied facets -->
        <?php if (!empty($results['appliedFacets'])) { ?>
        <?php foreach ($results['appliedFacets'] as $filter) { ?>
        <?php foreach ($filter['facetValue'] as $facetValue){ 
              $action = http_build_query(array('action'=>$facetValue['removeAction']));
        ?>
        <li>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">                 
            <img  src="web/delete.png"/>                      
        </a>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>"><?php echo $facetValue['Id']; ?>: <?php echo $facetValue['value']; ?></a>
        </li>
        <?php } } }?>
<!-- Applied limiters -->
        <?php if (!empty($results['appliedLimiters'])) { ?>    
        <?php foreach ($results['appliedLimiters'] as $filter) {
                  $limiterLabel = '';
                  foreach($Info['limiters'] as $limiter){
                      if($limiter['Id']==$filter['Id']){
                          $limiterLabel = $limiter['Label'];
                          break;
                      }
                  }
                  $action = http_build_query(array('action'=>$filter['removeAction']));
        ?>
        <li>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">                 
            <img  src="web/delete.png"/>                      
        </a>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">Limiter: <?php echo $limiterLabel; ?></a>
        </li>
        <?php } }?>        
<!-- Applied expanders -->
        <?php if (!empty($results['appliedExpanders'])) { ?>
        <?php foreach ($results['appliedExpanders'] as $filter) {
                    $expanderLabel = '';
                    foreach($Info['expanders'] as $exp){
                        if($exp['Id']==$filter['Id']){
                            $expanderLabel = $exp['Label'];
                            break;
                        }
                    }
                    $action = http_build_query(array('action'=>$filter['removeAction']));
             ?>
        <li>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">                 
            <img  src="web/delete.png"/>                      
        </a>
        <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">Expander: <?php echo $expanderLabel; ?></a>
        </li>
        <?php } } ?>        
    </ul>
</div>
<?php } ?>
<?php if(!empty($Info['limiters'])){?>
<div class="facets" style="font-size: 80%">
                <dl class="facet-label">
                    <dt>Limit your results</dt>
                </dl>
                <dl class="facet-label" >
                    <form action="limiter.php" method="get">
                   <?php for($i=0;$i<3;$i++){ ?>
                   <?php   $limiter=$Info['limiters'][$i]; ?>
                     <?php if($limiter['Type'] =='select'){?>
                      <?php if(empty($results['appliedLimiters'])){ ?>
                      <dd><input type="checkbox" value="<?php echo $limiter['Action'];?>" name="<?php echo $limiter['Id']; ?>" /><?php echo $limiter['Label'] ?></dd> 
                      <?php }else{
                                 $flag = FALSE;
                                 foreach($results['appliedLimiters'] as $filter){
                                    if($limiter['Id']==$filter['Id']){ 
                                        $flag = TRUE;
                                        break;
                                    }
                                 }    
                               if($flag==TRUE){ ?>
                                      <dd><input type="checkbox" value="<?php echo $limiter['Action'];?>" name="<?php echo $limiter['Id']; ?>" checked="checked" /><?php echo $limiter['Label'] ?></dd>                               
                      <?php  }else{ ?>
                                      <dd><input type="checkbox" value="<?php echo $limiter['Action'];?>" name="<?php echo $limiter['Id']; ?>" /><?php echo $limiter['Label'] ?></dd> 
                      <?php }}}}?>
                    <input type="hidden" value="<?php echo $searchTerm;?>" name="query" />
                    <input type="hidden" value="<?php echo $fieldCode;?>"  name="fieldcode" />
                    <input type="submit" value="Update" />
                    </form>               
                </dl>              
</div>
<?php } ?>
<div class="facet" style="font-size: 80%">
                <dl class="facet-label">
                    <dt>Expand your results</dt>
                </dl>
                <dl class="facet-label">
                <form action="expander.php">
                    <?php foreach($Info['expanders'] as $exp){
                       if(empty($results['appliedExpanders'])){ ?>
                           <dd><input type="checkbox" value="<?php echo $exp['Action'];?>" name="<?php echo $exp['Id']; ?>" /><?php echo $exp['Label'];?></dd>
                    <?php }else{
                        $flag = FALSE;
                        foreach($results['appliedExpanders'] as $aexp){
                            if($aexp['Id']==$exp['Id']){
                                $flag=TRUE;
                                break;
                            }
                        }
                        
                        if($flag==TRUE){ ?>
                           <dd><input type="checkbox" value="<?php echo $exp['Action'];?>" name="<?php echo $exp['Id']; ?>"  checked="checked"/><?php echo $exp['Label'];?></dd>
                   <?php }else{ ?>
                            <dd><input type="checkbox" value="<?php echo $exp['Action'];?>" name="<?php echo $exp['Id']; ?>" /><?php echo $exp['Label'];?></dd>
                   <?php   }
                    } 
                    }?>                 
                    <input type="hidden" value="<?php echo $searchTerm;?>" name="query" />
                    <input type="hidden" value="<?php echo $fieldCode;?>"  name="fieldcode" />
                    <input type="submit" value="Update"/>
                </form>
                </dl>
</div>            
<?php if (!empty($results['facets'])) { $i=0; ?>
    <div class="facets">
        <?php foreach ($results['facets'] as $facet) { $i++; ?>
        
        <?php if(!empty($facet['Label'])){ ?>
        <script type="text/javascript">            
                 $(document).ready(function(){             
                 $("#flip<?php echo $i ?>").click(function(){              
                 $("#panel<?php echo $i ?>").slideToggle("slow");
                 if($("#plus<?php echo $i ?>").html()=='[+]'){
                     $("#plus<?php echo $i ?>").html('[-]');
                 }else{
                     $("#plus<?php echo $i ?>").html('[+]');
                 }
                 
                 });   
                });
        </script>
        
            <div class="facet" style="font-size: 80%">                
                <dl class="facet-label" id="flip<?php echo $i ?>">
                    <dt><span style="font-weight: lighter" id="plus<?php echo $i ?>">[+]</span><?php echo $facet['Label']; ?></dt>
                </dl>
                <dl class="facet-values" id="panel<?php echo $i ?>">
                    
                        
                    <?php foreach ($facet['Values'] as $facetValue) { 
                     $action = http_build_query(array('action'=>$facetValue['Action']));
                    ?>
                        <dd>
                                                     
                            <a href="<?php echo $refineSearchUrl.'&'.$queryStringUrl.'&'.$action; ?>">
                             
                                <?php echo $facetValue['Value']; ?>
                            </a>
                            (<?php echo $facetValue['Count']; ?>)
                        </dd>
                    <?php } ?>                  
                </dl>
            </div>
          <?php } ?>
        <?php } ?>
    </div>
<?php } ?>

        </div>
<div class="table-cell">
<?php if($debug=='y'){?>
    <div style="float:right"><a target="_blank" href="debug.php?result=y">Search response XML</a></div>
<?php } ?>
<div class="top-menu">
    <h2>Results</h2> 
<?php if ($error) { ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php } ?>

<?php if (!empty($results)) { ?>
    <div class="statistics">
        Showing <strong><?php if($results['recordCount']>0){ echo ($start - 1) * $limit + 1;} else { echo 0; } ?>  - <?php if((($start - 1) * $limit + $limit)>=$results['recordCount']){ echo $results['recordCount']; } else { echo ($start - 1) * $limit + $limit;} ?></strong>  
            of <strong><?php echo $results['recordCount']; ?></strong>
            for "<strong><?php echo $searchTerm; ?></strong>"
    </div><br>            
    <div class ="topbar-resultList">
        <div class="optionsControls">
            <ul style="margin:3px 4px 4px 4px">              
                <li class="options-controls-li">                   
                    <form action="pageOptions.php">
                        <label><b>Sort</b></label>
                        <select onchange="this.form.submit()" name="sort" > 
                            <?php foreach($Info['sort'] as $s){ 
                                  if($sortBy==$s['Id']){ ?>
                                <option selected="selected" value="<?php echo $s['Action']; ?>"><?php echo $s['Label'] ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $s['Action']; ?>"><?php echo $s['Label'] ?></option>
                            <?php }}?>
                        </select>
                        <input type="hidden" value="<?php echo $searchTerm;?>" name="query" />
                        <input type="hidden" value="<?php echo $fieldCode;?>"  name="fieldcode" />      
                    </form>
                </li>
                 <li class="options-controls-li">
                      <?php $option = array(
                          'Detailed' => '',
                          'Brief' => '',
                          'Title' => '',                      
                          );
                              if($amount== 'detailed'){
                                  $option['Detailed']= '  selected="selected"';
                              }
                              if($amount== 'brief'){
                                  $option['Brief']= '  selected="selected"';
                              }
                              if($amount== 'title'){
                                  $option['Title']= '  selected="selected"';
                              }                              
                    ?>    
                    <form action="pageOptions.php">
                        <label><b>Page options</b></label>
                        <select onchange="this.form.submit()" name="view">
                            <option  <?php echo $option['Detailed']?> value="detailed">Detailed</option>
                            <option  <?php echo $option['Brief']?> value="brief">Brief</option>
                            <option  <?php echo $option['Title']?> value="title">Title Only</option>
                        </select>
                        <input type="hidden" value="<?php echo $searchTerm;?>" name="query" />
                        <input type="hidden" value="<?php echo $fieldCode;?>"  name="fieldcode" />  
                    </form>
                 </li>
                    <li class="options-controls-li">
                    
                    <?php $select = array(
                          '5' => '',
                          '10' => '',
                        '20' => '',
                        '30' => '',
                        '40' => '',
                        '50' => ''
                    );
                              if($limit== 5){
                                  $select['5']= '  selected="selected"';
                              }
                              if($limit== 10){
                                  $select['10']= '  selected="selected"';
                              }
                              if($limit== 20){
                                  $select['20']= '  selected="selected"';
                              }
                              if($limit== 30){
                                  $select['30']= '  selected="selected"';
                              }
                              if($limit== 40){
                                  $select['40']= '  selected="selected"';
                              }
                              if($limit== 50){
                                  $select['50']= '  selected="selected"';
                              }                          
                    ?>                          
                     <form action="pageOptions.php">
                        <label><b>Results per page</b></label>
                        <select onchange="this.form.submit()" name="resultsperpage">
                            <option <?php echo $select['5']?> value="setResultsperpage(5)">5</option>
                            <option <?php echo $select['10']?> value="setResultsperpage(10)">10</option>
                            <option <?php echo $select['20']?> value="setResultsperpage(20)">20</option>
                            <option <?php echo $select['30']?> value="setResultsperpage(30)">30</option>
                            <option <?php echo $select['40']?> value="setResultsperpage(40)">40</option>
                            <option <?php echo $select['50']?> value="setResultsperpage(50)">50</option>
                        </select>
                        <input type="hidden" value="<?php echo $searchTerm;?>" name="query" />
                        <input type="hidden" value="<?php echo $fieldCode;?>"  name="fieldcode" />  
                    </form>
                    </li>
                </ul>
        </div>
     </div>
<div style="text-align: center">
    <div class="pagination"><?php echo paginate($results['recordCount'], $limit, $start, $encodedSearchTerm, $fieldCode); ?></div>
</div>
<?php } ?>

<div class="results table">
    <?php if (empty($results['records'])) { ?>
        <div class="result table-row">
            <div class="table-cell">
                <h2><i>No results were found.</i></h2>
            </div>
        </div>
    <?php } else { ?>
        <?php foreach ($results['records'] as $result) { ?>
            <div class="result table-row">
                <div class="record-id table-cell">
                    <?php echo $result['ResultId']; ?>.
                </div>               
                 <?php if (!empty($result['pubType'])) { ?>
                <div class="pubtype table-cell" style="text-align: center">  
                    <?php if (!empty($result['ImageInfo'])) { ?>                    
                    <a href="record.php?db=<?php echo $result['DbId']; ?>&an=<?php echo $result['An']; ?>&<?php echo $encodedHighLigtTerm ?>&resultId=<?php echo $result['ResultId'];?>&recordCount=<?php echo $results['recordCount']; ?>&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>">                         
                                <img src="<?php echo $result['ImageInfo']['thumb']; ?>" />                                                                       
                        </a> 
                    <?php }else{ 
                     $pubTypeId =  $result['PubTypeId'];                    
                     $pubTypeClass = "pt-".$pubTypeId;
                    ?>
                    <span class="pt-icon <?php echo $pubTypeClass?>"></span>
                    <?php } ?>
                    <div><?php echo $result['pubType'] ?></div>
                </div>     
                <?php } ?>       
                <div class="info table-cell">
                    <div style="margin-left: 10px">
                        
                        <?php if((!isset($_COOKIE['login']))&&$result['AccessLevel']==1){ ?>
                            <p>This record from <b>[<?php echo $result['DbLabel'] ?>]</b> cannot be displayed to guests.<a href="login.php?path=results&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>">Login</a> for full access.</p>
                       <?php }else{  ?>
                        <div class="title">                     
                            <?php if (!empty($result['RecordInfo']['BibEntity']['Titles'])){ ?>
                            <?php foreach($result['RecordInfo']['BibEntity']['Titles'] as $Ti){ ?> 
                            <a href="record.php?db=<?php echo $result['DbId']; ?>&an=<?php echo $result['An']; ?>&<?php echo $encodedHighLigtTerm ?>&resultId=<?php echo $result['ResultId'];?>&recordCount=<?php echo $results['recordCount']; ?>&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>"><?php echo  $Ti['TitleFull']; ?></a>
                           <?php } }
                            else { ?> 
                            <a href="record.php?db=<?php echo $result['DbId']; ?>&an=<?php echo $result['An']; ?>&<?php echo $encodedHighLigtTerm ?>&resultId=<?php echo $result['ResultId'];?>&recordCount=<?php echo $results['recordCount']; ?>&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>"><?php echo "Title is not Aavailable"; ?></a>                   
                          <?php  } ?>                
                        </div>
                        <?php if(!empty($result['Items']['TiAtl'])){ ?>
                        <div>
                        <?php foreach($result['Items']['TiAtl'] as $TiAtl){ 
                              echo $TiAtl['Data']; 
                              } ?>
                        </div>
                        <?php } ?>
                        <?php if (!empty($result['Items']['Au'])) { ?>
                        <div class="authors">
                            <span>
                                <span style="font-style: italic;">By : </span>                                            
                                 <?php foreach($result['Items']['Au'] as $Author){ ?>                                    
                                    <?php echo $Author['Data']; ?>;                                
                                 <?php } ?>
                            </span>                        
                        </div>                        
                        <?php } ?>
                        <div class="authors">
                        <span style="font-style: italic; ">
                        <?php if(isset($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Titles'])){?>                                                 
                             <?php foreach($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Titles'] as $title){ ?>
                               <?php echo $title['TitleFull']?>,                                  
                        <?php }}?>
                        </span>
                        <?php if(!empty($result['RecordInfo']['BibEntity']['Identifiers'])){
                                 foreach($result['RecordInfo']['BibEntity']['Identifiers'] as $identifier){
                                     $pieces = explode('-',$identifier['Type']); 
                                     if(isset($pieces[1])){                                       
                                       echo strtoupper($pieces[0]).'-'.ucfirst( $pieces[1]);                                       
                                       }else{ 
                                       echo strtoupper($pieces[0]);
                                       }?>: <?php echo $identifier['Value']?>,                                                                
                        <?php }} ?>
                        <?php if(isset($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Identifiers'])){?>
                             <?php foreach($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Identifiers'] as $identifier){
                                    $pieces = explode('-',$identifier['Type']);
                                    if(isset($pieces[1])){                                        
                                       echo strtoupper( $pieces[0]).'-'.ucfirst( $pieces[1]);                                       
                                       }else{ 
                                       echo strtoupper($pieces[0]);
                                       }?>: <?php echo $identifier['Value']?>, 
                             <?php }?>  
                        <?php }?>
                        <?php if(isset($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'])){?>
                             <?php foreach($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'] as $date){ ?>
                                 Published: <?php echo $date['M']?>/<?php echo $date['D']?>/<?php echo $date['Y']?>, 
                             <?php }?> 
                        <?php }?>
                        <?php if(isset($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['numbering'])){ 
                                foreach($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['numbering'] as $number){?>
                                  <?php $type = str_replace('volume','Vol',$number['Type']); $type = str_replace('issue','Issue',$type); ?>
                                    <?php echo $type;?>: <?php echo $number['Value']; ?>, 
                        <?php } } ?>
                        <?php if(!empty($result['RecordInfo']['BibEntity']['PhysicalDescription']['StartPage'])){?>
                                 Start Page: <?php echo $result['RecordInfo']['BibEntity']['PhysicalDescription']['StartPage']?>, 
                        <?php } ?>                        
                        <?php if(!empty($result['RecordInfo']['BibEntity']['PhysicalDescription']['Pagination'])){ ?>
                                 Page Count: <?php echo $result['RecordInfo']['BibEntity']['PhysicalDescription']['Pagination']?>, 
                        <?php } ?>
                        <?php if(!empty($result['RecordInfo']['BibEntity']['Languages'])){ ?>
                        <?php foreach($result['RecordInfo']['BibEntity']['Languages'] as $language){ ?> 
                                 Language: <?php echo $language['Text']?>
                        <?php } }?>
                        </div>
                        <?php if (isset($result['Items']['Ab'])) { ?>
             <script type="text/javascript">            
                 $(document).ready(function(){             
                 $("#abstract-plug<?php echo $result['ResultId']; ?>").click(function(){              
                     $("#full-abstract<?php echo $result['ResultId']; ?>").show() ; 
                     $("#abstract<?php echo $result['ResultId']; ?>").hide() ; 
                 }); 
                 $("#full-abstract-plug<?php echo $result['ResultId']; ?>").click(function(){              
                     $("#full-abstract<?php echo $result['ResultId']; ?>").hide() ; 
                     $("#abstract<?php echo $result['ResultId']; ?>").show() ; 
                 });   
                });
             </script>
                        <div id="abstract<?php echo $result['ResultId'];?>" class="abstract">
                            <span>
                                <span style="font-style: italic;">Abstract: </span>                                    
                                      <?php foreach($result['Items']['Ab'] as $Abstract){ ?>                                            
                                                     <?php
                                                      $xml ="Config.xml";
                                                      $dom = new DOMDocument();
                                                      $dom->load($xml);      
                                                      $length = $dom ->getElementsByTagName('AbstractLength')->item(0)->nodeValue;      
                                                      if($length == 'Full'){
                                                            echo $Abstract['Data'];
                                                      }else{
                                                            $data = str_replace(array('<span class="highlight">','</span>'), array('',''), $Abstract['Data']);
                                                            $data = substr($data, 0, $length).'...';
                                                            
                                                            echo $data;
                                                      }
                                                     ?>                                                
                                            <?php } ?>                                  
                                        
                                    <span id="abstract-plug<?php echo $result['ResultId'];?>">[+]</span>                                
                            </span>
                        </div>
                        <div id="full-abstract<?php echo $result['ResultId'];?>" class="full-abstract">
                            <span>
                                    <span style="font-style: italic;">Abstract: </span>
                                          <?php foreach($result['Items']['Ab'] as $Abstract){ ?>                                          
                                               <?php echo $Abstract['Data']; ?>                                                                                                                                                   
                                          <?php } ?>                                        
                                    <span id="full-abstract-plug<?php echo $result['ResultId'];?>">[-]</span>
                                </tr>
                            </span>
                        </div>
                      <?php } ?>
                      <?php if (!empty($result['Items']['Su'])) { ?>
                        <div class="subjects">
                            <span>
                                    <span style="font-style: italic;">Subjects:</span>
                                             <?php foreach($result['Items']['Su'] as $Subject){ ?>
                                            <?php echo $Subject['Data']; ?>; 
                                             <?php } ?> 
                            </span>
                        </div>
                      <?php } ?>
                      <div class="links">
                         <?php if($result['HTML']==1){?> 
                          <?php if((!isset($_COOKIE['login']))&&$result['AccessLevel']==2){ ?> 
                        <a target="_blank" class="icon html fulltext" href="login.php?path=HTML&an=<?php echo $result['An']; ?>&db=<?php echo $result['DbId']; ?>&<?php echo $encodedHighLigtTerm ?>&resultId=<?php echo $result['ResultId'];?>&recordCount=<?php echo $results['recordCount']?>&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>">Full Text</a>
                          <?php } else{?>
                        <a target="_blank" class="icon html fulltext" href="record.php?an=<?php echo $result['An']; ?>&db=<?php echo $result['DbId']; ?>&<?php echo $encodedHighLigtTerm ?>&resultId=<?php echo $result['ResultId'];?>&recordCount=<?php echo $results['recordCount']?>&<?php echo $encodedSearchTerm;?>&fieldcode=<?php echo $fieldCode; ?>#html">Full Text</a>
                         <?php } ?>                          
                        <?php } ?>
                        <?php if(!empty($result['PDF'])){?> 
                          <a target="_blank" class="icon pdf fulltext" href="PDF.php?an=<?php echo $result['An']?>&db=<?php echo $result['DbId']?>">Full Text</a>
                        <?php } ?>
                      </div>
                      <?php if (!empty($result['CustomLinks'])){ ?>
                      <div class="custom-links">
                      <?php if (count($result['CustomLinks'])<=3){?> 
                    
                            <?php foreach ($result['CustomLinks'] as $customLink) { ?>
                                <p>
                                 <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><img src="<?php echo $customLink['Icon']?>" /> <?php echo $customLink['Name']; ?></a>
                                </p>
                            <?php } ?>
                    
                      <?php } else {?>
                    
                            <?php for($i=0; $i<3 ; $i++){
                                $customLink = $result['CustomLinks'][$i];
                                ?>
                                <p> 
                                   <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><?php echo $customLink['Name']; ?></a>
                                </p>
                            <?php } ?>
                    
                      <?php } ?>                   
                      </div>                      
                      <?php } ?>
                      <?php if (!empty($result['FullTextCustomLinks'])){ ?>
                      <div class="custom-links">
                      <?php if (count($result['FullTextCustomLinks'])<=3){?>                     
                            <?php foreach ($result['FullTextCustomLinks'] as $customLink) { ?>
                                <p>
                                 <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><img src="<?php echo $customLink['Icon']?>" /> <?php echo $customLink['Name']; ?></a>
                                </p>
                            <?php } ?>                    
                      <?php } else {?>                    
                            <?php for($i=0; $i<3 ; $i++){
                                $customLink = $result['FullTextCustomLinks'][$i];
                                ?>
                                <p> 
                                   <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><?php echo $customLink['Name']; ?></a>
                                </p>
                            <?php } ?>
                    
                      <?php } ?>                   
                      </div>                     
                      <?php } ?>
                      <?php } ?>
                </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<?php if (!empty($results)) { ?>
    <div style="text-align: center">
        <div class="pagination"><?php echo paginate($results['recordCount'], $limit, $start, $encodedSearchTerm, $fieldCode); ?></div>       
    </div>
<?php } ?>
        </div>
    </div>
</div>
</div>      
</div>

