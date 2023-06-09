<?php 
$error=[];


function validationForEmpty($input,$inputName,&$error):bool
{
    if(empty($input)){
        $error[$inputName]="<p class='text-danger font-weight-bold'>*$inputName is required</p>";
    }
    // return true;
    return true;
}



function validationForName($firstName,&$error):void
{
    validationForEmpty($firstName,"name",$error);

}


function validation($data) :array
{
    global $error;
    validationForName($data['name'],$error);
    return $error;
}
