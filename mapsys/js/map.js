var city_name="福州";

var imgurl = "http://d2.img.com/";
if(bmaplng==undefined) var bmaplng;
if(bmaplat==undefined) var bmaplat;
var bmap;
var ac_addr_name;
var ac_area_name;
var ac_path_from,ac_path_to;







// 初始化地图
// 默认显示当前所在城市
function BmapInit() {  
 	bmap = new BMap.Map('map_canvas');	
	bmaplat=$('#s_lat').val();
	bmaplng=$('#s_lng').val();
	
	if(!bmaplng || !bmaplat){
		var currentCity = new BMap.LocalCity();
		currentCity.get(getCity); 
	}else{
		bmap.centerAndZoom(new BMap.Point(bmaplng, bmaplat), 18);
		addMarker(new BMap.Point(bmaplng, bmaplat), 0);
	}
	
	bmap.addControl(new BMap.NavigationControl());  			 //导航
	bmap.addControl(new BMap.MapTypeControl()); 				 //类型
	bmap.addControl(new BMap.OverviewMapControl());              //添加默认缩略地图控件
	bmap.addControl(new BMap.OverviewMapControl({isOpen:true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));   //右上角，打开
	bmap.enableScrollWheelZoom();
	
	
	
	//自动搜索
	var ac_addr_name = new BMap.Autocomplete(    
    {"input" : "addr_name"
    ,"location" : city_name
	});
	
	
	var ac_area_name = new BMap.Autocomplete(    
		    {"input" : "area_name"
		    ,"location" : city_name
	});
	
	
	var ac_path_from = new BMap.Autocomplete(    
		    {"input" : "path_from"
		    ,"location" : city_name
	});
	
	var ac_path_to =   new BMap.Autocomplete(    
		    {"input" : "path_to"
		        ,"location" : city_name
	});
		    	
			
	
	
	//获得当前城市
	function getCity(result){
		city_name = result.name;
		bmap.centerAndZoom(result.name, 12);	
	}
}



//搜索地图
function map_search(){
	bmap.clearOverlays();    //清除地图上所有覆盖物
	var search_txt = document.getElementById('search_txt').value;
	// 创建地址解析器实例
	var bmyGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
	bmyGeo.getPoint(search_txt, function(point){
	if (point) {
			bmap.centerAndZoom(point, 18);
			addMarker(point,1);
	}
	else
	{
			alert('查无此点，请输入“xx市xx镇xx村xx街道这样的地址”');  
	}
	},"中国");
}

/**
 * 设置百度的经纬度
 * @param marker
 * @return
 */
function setLngLat(marker){
	marker.enableDragging(); //是否可以拖动
	marker.addEventListener('dblclick',function(e){
		
		document.getElementById('s_lng').value = e.point.lng;
		document.getElementById('s_lat').value = e.point.lat;
		
		document.getElementById('wd').value = e.point.lng;
		document.getElementById('jd').value = e.point.lat;
	});
}


//添加地标
function addMarker(point, index) {
	var myIcon = new BMap.Icon("/images/map/1.png", new BMap.Size(27, 38), {
		anchor: new BMap.Size(10, 27)
	});
	
	var marker = new BMap.Marker(point, { icon: myIcon });
	bmap.addOverlay(marker);
	getLngLat(marker);
	marker.enableDragging(); //是否可以拖动
	return marker;
}

//获得百度坐标
function getLngLat(marker){
	marker.enableDragging(); //是否可以拖动
	marker.addEventListener('dblclick',function(e){
		document.getElementById('s_lng').value = e.point.lng;
		document.getElementById('s_lat').value = e.point.lat;
		
		document.getElementById('wd').value = e.point.lng;
		document.getElementById('jd').value = e.point.lat;

		bmaplng = e.point.lng;
		bmaplat = e.point.lat;
		b2gFitLocation();
		marker.openInfoWindow(new BMap.InfoWindow('已经选定坐标：'+e.point.lng+","+e.point.lat));
	});
}



function searchPoint()
{
	var addr_name = $('#addr_name').val();
	var addr_car  = $('#addr_cat').find('option:selected').text();
	var addr_prov = $('#addr_prov').find('option:selected').text();
	if(!addr_name)
	{
		alert("请输入名称");
		return;
	}
	
	bmap.clearOverlays();    //清除地图上所有覆盖物
	var search_txt = addr_name;
	var bmyGeo = new BMap.Geocoder();
	bmyGeo.getPoint(search_txt, function(point){
	if (point) {
			bmap.centerAndZoom(point, 18);
			addMarker(point,1);
	}
	else
	{
			alert('查无此点，请输入“xx市xx镇xx村xx街道这样的地址”');  
	}
	},"中国");
}

function searchArea()
{
	var area_name = $('#area_name').val();
	var area_car  = $('#area_cat').find('option:selected').text();
	var area_dist = $('#area_dist').find('option:selected').text();
	if(!area_name)
	{
		alert("请输入地址");
		return;
	}
	
	
	
	
}
function searchPath()
{
	var path_from = $('#path_from').text();
	var path_to   = $('#path_to').text();
	
	if(!path_from)
	{
		alert("请输入出发地点");
		return;
	}
	
	if(!path_to)
	{
		alert("请输入目的地点");
		return;
	}
}



//--------------  将百度地图转换为google地图
var amaplat = 0.000000;
var amaplng = 0.000000;
var bm_lat = 0;
var bm_lon = 0;
var delta_lat = 0;
var delta_lon = 0;

function b2gFitLocation() {
	if(!amaplng) amaplng = 0.000000;
	if(!amaplat) amaplat = 0.000000;
    var point = new BMap.Point(amaplng, amaplat);
    BMap.Convertor.translate(point, 2, b2gTranslateCallback);
}

function b2gTranslateCallback(point) {
	var result_lat = bmaplat || document.getElementById('bmaplat').value;
	var result_lon = bmaplng || document.getElementById('bmaplng').value;
	
    bm_lat = point.lat.toFixed(6);
    bm_lon = point.lng.toFixed(6);
    delta_lat = (point.lat - result_lat).toFixed(6);
    delta_lon = (point.lng - result_lon).toFixed(6);

    var abs_delta_lat = Math.abs(delta_lat * 1e6);
    var abs_delta_lon = Math.abs(delta_lon * 1e6);
    if (abs_delta_lat < 2 && abs_delta_lon < 2) {
		document.getElementById('amaplat').value = amaplat;
		document.getElementById('amaplng').value = amaplng;
		//amap.setCenter(new AMap.LngLat(amaplng, amaplat)); 
		//amap.setZoom(16); 
    } else {
        amaplat = amaplat - delta_lat;
        amaplng = amaplng - delta_lon;
        b2gFitLocation();
    }
}


// 添加信息窗口
function addInfoWindow(marker, poi, index) {
	var maxLen = 6;
	var name = null;
	var address="";
	if (poi.type == BMAP_POI_TYPE_NORMAL) {
		name = "地址：  "                
		address=poi.title;                
	} else if (poi.type == BMAP_POI_TYPE_BUSSTOP) {
		name = "公交：  "
		address=poi.title+"公交站";
	} else if (poi.type == BMAP_POI_TYPE_SUBSTOP) {
		name = "地铁：  "
		address=poi.title+"地铁站";
	}else{
		address=poi.title;                
	}
	var infoWindowHtml = contentinfohtml(address, poi.point, poi.city);
	var infoWindow = new BMap.InfoWindow(infoWindowHtml, { width: 320, offset: new BMap.Size(0, -14) });
	var openInfoWinFun = function () {
		ifmarker = "marker";
		marker.openInfoWindow(infoWindow);
		for (var cnt = 0; cnt < maxLen; cnt++) {
			if (!$("#divid" + cnt)) { continue; }
			if (cnt == index) {
				$("#divid" + cnt).css("background", "#CAE1FF");
				$("img", $("#divid" + cnt)).attr("src", imgurl + "static/img/other/gaode/" + (cnt + 1) + "_1.png");
				var myIcon = new BMap.Icon(imgurl + "static/img/other/gaode/" + (cnt + 1) + "_1.png", new BMap.Size(22, 29), {
					anchor: new BMap.Size(10, 27)
				});
				markers[cnt].setIcon(myIcon);
			} else {
				$("#divid" + cnt).css("background", "");
				$("img", $("#divid" + cnt)).attr("src", imgurl + "static/img/other/gaode/" + (cnt + 1) + ".png");
				var myIcon = new BMap.Icon(imgurl + "static/img/other/gaode/" + (cnt + 1) + ".png", new BMap.Size(22, 29), {
					anchor: new BMap.Size(10, 27)
				});
				markers[cnt].setIcon(myIcon);
			}
		}
	}
	marker.addEventListener("click", openInfoWinFun);
	marker.addEventListener("mouseout", function (e) {
		ifmarker = "";
	});
	ifmarker = "";
	return openInfoWinFun;
}

 function contentinfohtml(address, pt, city) {
            var contentinfo = "";
            contentinfo = "<div><p style=\"width:290px;\">地址：" + address + "</p>"
		+ "</div>";
            return contentinfo;
}

function openMarkerTipById0(pointid, thiss) {  //鼠标经过时候       
            for (i = 0; i < markers.length; i++) {
                if (pointid == i) {
                    $(thiss).css("background", "#CAE1FF");
                    var imgid = parseInt(pointid) + 1;
                    $("img", thiss).attr("src", imgurl + "static/img/other/gaode/" + imgid + "_1.png");
                    var myIcon = new BMap.Icon(imgurl + "static/img/other/gaode/" + imgid + "_1.png", new BMap.Size(22, 29), {
                        anchor: new BMap.Size(10, 27)
                    });
                    markers[pointid].setIcon(myIcon);
                } else {
                    $("#divid" + i).css("background", "");
                    $("img", $("#divid" + i)).attr("src", imgurl + "static/img/other/gaode/" + (i + 1) + ".png");
                    var myIcon = new BMap.Icon(imgurl + "static/img/other/gaode/" + (i + 1) + ".png", new BMap.Size(22, 29), {
                        anchor: new BMap.Size(10, 27)
                    });
                    markers[i].setIcon(myIcon);
                }
            }
}

function openMarkerTipById1(pointid, thiss) {  //根据id打开搜索结果点tip
	$(thiss).css("background", "#CAE1FF");
	var imgid = parseInt(pointid) + 1;
	openInfoWinFuns[pointid]();
	var myIcon = new BMap.Icon(imgurl + "static/img/other/gaode/" + imgid + "_1.png", new BMap.Size(22, 29), {
		anchor: new BMap.Size(10, 27)
	});
	markers[pointid].setIcon(myIcon);
	marker_on = pointid;
}

function onmouseout_MarkerStyle(pointid, thiss) { //鼠标移开后点样式恢复          
	ifmarker = "";
}



