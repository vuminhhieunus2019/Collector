<div id="interactive_gui"></div>
<input id="add_interactive_button" type='button' class='collectorButton' value='Add'>          
<textarea id="raw_script" style="display:none"></textarea> <!-- perhaps can remove this and related code -->
<div id="preprocessing_trialType" style="position:relative;display:none"></div>

  
<script>

$("#add_interactive_button").on("click",function(){
    
    //update temp_gui_var
  
    if(typeof(temp_GUI_Var)=="undefined"){
        temp_GUI_Var = []
    } else {
        interaction_manager.curr_int_no = Object.keys(temp_GUI_Var).length;
        //    var this_index = Object.keys(temp_GUI_Var).length;
        temp_GUI_Var[interaction_manager.curr_int_no]={};
        
    } 
    
    if(typeof(temp_GUI_Var[0]["gui_function"]) == "undefined"){
        interaction_manager.curr_int_no=0;
        
        temp_GUI_Var = {
        }
        temp_GUI_Var[0] = {
            gui_function:"",
        }    
        
        // need to draw in span to alert the task that there is script to be written in!
    
        
        var iframe_width = $("iFrame").width();
        var mouseover_mouseout = "onmouseover='this.style.color=\"black\"' "+
                                   "onmouseout='this.style.color=\"white\"' ";
          
        script_style="style='position:absolute;bottom:0px;left:0px;width:"+iframe_width+"px;background-color:blue;color:white;opacity:90%;padding:0px;text-align:center'";
        
        
        var script_span = "<span "+mouseover_mouseout+" "+script_style+" onclick='edit_script(0)' class='script_element' id='gui_script'>___script0___</span>";
        
        var iframeBody = $("#canvas_iframe").contents().find("#canvas_in_iframe");
        iframeBody.append(script_span);
        
        
    }
    
    this_script_no = interaction_manager.curr_int_no;
        temp_GUI_Var[this_script_no]['gui_function']    =   "tbc";
        temp_GUI_Var[this_script_no]['target']          =   "tbc";
    
    new_int_row =   "<span id='gui_interactive_span_"+this_script_no+"'>"+this_script_no+
        "<span id='gui_button"+this_script_no+"' class='gui_button_unclicked' onclick='interactive_gui_button_click(\""+[this_script_no]+"\")'>"+temp_GUI_Var[this_script_no]['gui_function']+" : "+temp_GUI_Var[this_script_no]['target']+"</span>"+      
            "<input type='button' class='collectorButton' value='delete' onclick='interaction_manager.delete_script("+this_script_no+")'>"+
        "</span>"+
        "<br>";
    
    
    $("#interactive_gui").append(new_int_row);
    
    
    
    $("#select_interactive_function").val("--- select a function ---");
    $("#select_interactive_function").show();
    
    

    
  
  $(".interactive_divs").hide();
  // buttons should be highlighted depending on which script is being edited!
  
});

</script>
<select id='select_interactive_function' style="display:none">
<div id="gui_script_editor">
  <?php 
    $dir = "GUI/Interactive";
    $interactive_functions = array_diff(scandir($dir), array('.', '..'));
    
    print_r($interactive_functions);
  echo "<option>--- select a function ---</option>";
  foreach ($interactive_functions as $interactive_function){
    $interactive_function = str_ireplace(".php","",$interactive_function);
    echo "<option>$interactive_function</option>";
  }
  ?>
</select>            
  
  <?php
  foreach ($interactive_functions as $interactive_function){
    $this_div_name = str_ireplace(".php","",$interactive_function);
    echo "<div id='interactive_$this_div_name' class='interactive_divs'>";
      require("GUI/Interactive/$interactive_function");
    echo "</div>";
  }
   
  ?>
</div>