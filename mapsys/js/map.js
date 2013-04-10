var city_name;


function change_map_search(obj,type){
	if(type==0){
		$('#search_txt').val('请先选择搜索方式');
		return false;
	}else{
		if($('#city_id').val()!=0){
			city_name = $.trim($('#city_id').find("option:selected").text());
			if(!city_name){
				$(obj).val(0);
				$('#search_txt').html('请先选择搜索方式');
				La.Dialog.tip('请选择该商家的城市！');
				return false;
			}
		}else{
			$(obj).val(0);
			$('#search_txt').html('请先选择搜索方式');
			La.Dialog.tip('请先商家所在选择城市');
			return false;
		}
		if(type==1){
			var address = $.trim($('#b_address').val());
			if(!address){
				La.Dialog.tip('请输入商家的地址');
				$(obj).val(0);
				$('#search_txt').html('请先选择搜索方式');
				return false;
			}
			$('#search_txt').val(city_name+' '+address);
		}else{
			var sp_name = $.trim($('#b_name').val());
			if(!sp_name){
				La.Dialog.tip('请先输入商家名称');
				$(obj).val(0);
				$('#search_txt').html('请先选择搜索方式');
				return false;
			}
			$('#search_txt').val(city_name+' '+sp_name);
		}
	}
}

var imgurl = "http://d2.lashouimg.com/";
if(bmaplng==undefined) var bmaplng;
if(bmaplat==undefined) var bmaplat;
var bmap;

//初始化地图
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
	bmap.addControl(new BMap.NavigationControl());  
	bmap.addControl(new BMap.MapTypeControl());
	bmap.enableScrollWheelZoom();
	
	//自动搜索
	var ac = new BMap.Autocomplete(    
    {"input" : "search_txt"
    ,"location" : city_name
	});
	
	//获得当前城市
	function getCity(result){
		city_name = result.name;
		bmap.centerAndZoom(result.name, 12);	
	}
}


function getUrlParas(){
    var hash = location.hash,
        para = {},
        tParas = hash.substr(1).split("&");
    for(var p in tParas){
        if(tParas.hasOwnProperty(p)){
            var obj = tParas[p].split("=");
            para[obj[0]] = obj[1];
        }
    }
    return para;
}

var para = getUrlParas(),
center = para.address?decodeURIComponent(para.address) : "百度大厦",
city = para.city?decodeURIComponent(para.city) : "北京市";

document.getElementById("keyword").value = center;

var marker_trick = false;
var map = new BMap.Map("map_container");
map.enableScrollWheelZoom();

var marker = new BMap.Marker(new BMap.Point(116.404, 39.915), {
enableMassClear: false,
raiseOnDrag: true
});
marker.enableDragging();
map.addOverlay(marker);

map.addEventListener("click", function(e){
if(!(e.overlay)){
    map.clearOverlays();
    marker.show();
    marker.setPosition(e.point);
    setResult(e.point.lng, e.point.lat);
}
});
marker.addEventListener("dragend", function(e){
setResult(e.point.lng, e.point.lat);
});

var local = new BMap.LocalSearch(map, {
renderOptions:{map: map},
 pageCapacity: 1
});
local.setSearchCompleteCallback(function(results){
if(local.getStatus() !== BMAP_STATUS_SUCCESS){
    alert("无结果");
} else {
     marker.hide();
 }
});
local.setMarkersSetCallback(function(pois){
for(var i=pois.length; i--; ){
    var marker = pois[i].marker;
    marker.addEventListener("click", function(e){
        marker_trick = true;
        var pos = this.getPosition();
        setResult(pos.lng, pos.lat);
    });
}
});

window.onload = function(){
local.search(center);
document.getElementById("search_button").onclick = function(){
    local.search(document.getElementById("keyword").value);
};
document.getElementById("keyword").onkeyup = function(e){
    var me = this;
    e = e || window.event;
    var keycode = e.keyCode;
    if(keycode === 13){
        local.search(document.getElementById("keyword").value);
    }
};
};
function a(){
	document.getElementById("float_search_bar").style.display = "none";
}

/*
* setResult : 定义得到标注经纬度后的操作
* 请修改此函数以满足您的需求
* lng: 标注的经度
* lat: 标注的纬度
*/
function setResult(lng, lat){
	document.getElementById("result").innerHTML = lng + ", " + lat;
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
	var myIcon = new BMap.Icon( imgurl + "static/img/other/gaode/" + (index + 1) + ".png", new BMap.Size(22, 29), {
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
