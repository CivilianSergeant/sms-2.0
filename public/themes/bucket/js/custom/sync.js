/**
 * Created by Himel on 5/28/14.
 */
$(function(){
   var $classElm = $("select[name=class_id]");
    if($classElm.val())
    {
        var classObj = new Classes();
        classObj.sections($classElm.val(),$("select[name=section_id]"));
    }
});