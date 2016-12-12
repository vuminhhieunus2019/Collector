  var x = document.getElementById('lone_variable');
  
  Columns=Object.keys(data_by_columns);
  
  for(i=0; i<Columns.length; i++){
    var option = document.createElement("option");
    option.text = Columns[i];
    x.add(option);    
  }    
  
  /*
  if(selects_to_populate.indexOf('lone_variable') == -1){
    selects_to_populate[selects_to_populate.length]='lone_variable';
  }
  */

  function report_t_test_one_sample(input_variable,baseline){
  
    var script    = "report_t_test_one_sample('"+input_variable+"',"+baseline+")";
    script_array[script_array.length]=script;
    
    var sum_array = data_by_columns[input_variable];
    t_test_results = calculate_t_test_one_sample(sum_array,baseline);
    
    var output = "<br> t_test_one_sample("+ input_variable +") <br> t("+ t_test_results[1] +") = " + t_test_results[0] +
                            ", p = "+t_test_results[2]+
                            "<br>"+t_test_results[3];// descriptives
    
    var graph='[ figure not coded yet!]';
        
    if(typeof one_sample_ttest_no == "undefined"){
      one_sample_ttest_no=0;
    } else {
      one_sample_ttest_no++;
    }
    
    new_content_for_output_area = 
    
    '<div id="'+        
    'one_sample_ttest'+one_sample_ttest_no+"_div"+        
    '">'+output+"<br>"+graph+    
    "<br><button type='button' id='one_sample_ttest"+one_sample_ttest_no+"' onclick='add_to_script("+(script_array.length-1)+")'>Add to script</button>"+
      "<button type='button' onclick='remove_from_output(\"one_sample_ttest"+one_sample_ttest_no+"_div\")'>Remove from output</button>"+
      "<hr style='background-color:black'></hr></div>";
    
    $("#output_area").append(new_content_for_output_area);
    
  }  
