var LastLeftID = "";
function DoMenu(emid)
{
var obj = document.getElementById(emid); 
obj.className = (obj.className.toLowerCase() == "expanded"?"collapsed":"expanded");
if((LastLeftID!="")&&(emid!=LastLeftID)) //关闭上一个Menu
{
document.getElementById(LastLeftID).className = "collapsed";
}
LastLeftID = emid;
}
function GetMenuID()
{
var MenuID="";
var _paramStr = new String(window.location.href);
var _sharpPos = _paramStr.indexOf("#");
if (_sharpPos >= 0 && _sharpPos < _paramStr.length - 1)
{
_paramStr = _paramStr.substring(_sharpPos + 1, _paramStr.length);
}
else
{
_paramStr = "";
}
if (_paramStr.length > 0)
{
var _paramArr = _paramStr.split("&");
if (_paramArr.length>0)
{
   var _paramKeyVal = _paramArr[0].split("=");
   if (_paramKeyVal.length>0)
   {
    MenuID = _paramKeyVal[1];
   }
}

}
if(MenuID!="")
{
DoMenu(MenuID)
}
}
GetMenuID(); 

