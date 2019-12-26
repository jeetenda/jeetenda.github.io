var param1var = getQueryVariable("img");

alert(param2var);
function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
  } 
  
}

var str = window.location.href;
var res = str.replace("https://jeetenda.github.io/imagesearch/edit_image.html?img=", "");




function download() {
  var download = document.getElementById("download");
  var image = document.getElementById("canvas1").toDataURL("image/png")
      .replace("image/png", "image/octet-stream");
  download.setAttribute("href", image);
  //download.setAttribute("download","archive.png");
  }
  download();
  var canvas = new fabric.Canvas('canvas1');
  //      `${param1var}`
canvas.setBackgroundImage(str, canvas.renderAll.bind(canvas));
alert(param1var);
$('.add_shape').click(function(){
	var cur_value = $(this).attr('data-rel');
	if(cur_value!='')
	{


        
		switch(cur_value){
            case 'Triangle':
				var rect = new fabric.Triangle({
					left: 50,
					top: 50,
					fill: '#aaa',
					width: 50,
					height: 50,
					opacity: 1,
					stroke: '#000',
					strokeWidth: 1
				});
				canvas.add(rect);
				canvas.setActiveObject(rect);
				break;
			case 'rectangle':
				var rect = new fabric.Rect({
					left: 50,
					top: 50,
					fill: '#aaa',
					width: 50,
					height: 50,
					opacity: 1,
					stroke: '#000',
					strokeWidth: 1
				});
				canvas.add(rect);
				canvas.setActiveObject(rect);
				break;
			case 'circle':
				var circle = new fabric.Circle({
					left: 50,
					top: 50,
					fill: '#aaa',
					radius: 50,
					opacity: 1,
					stroke: '#000',
					strokeWidth: 1
				});
				canvas.add(circle);
				canvas.setActiveObject(circle);
				break;
		}
	}
});

canvas.on('object:scaling', (e) => {
  var o = e.target;
  if (!o.strokeWidthUnscaled && o.strokeWidth) {
                   o.strokeWidthUnscaled = o.strokeWidth;
  }
  if (o.strokeWidthUnscaled) {
                    o.strokeWidth = o.strokeWidthUnscaled / o.scaleX;
  }
});

$(".add_text").click(function(){
    var add_text = new fabric.IText('Edit Here', { 
    left: 20, 
    top: 30,
    fontSize:18,
    editable : true
  });

  add_text.initBehavior();
  canvas.add(add_text);
  canvas.setActiveObject(add_text);
});

$("#font_change").change(function(){
  	var font_style = $(this).val();
	if(font_style=='')
	{
		alert('Please select a Font Style');
		return false;
	}
	var tObj = canvas.getActiveObject();
	//Check that text is selected
	if(tObj==undefined)
	{
		alert('Please select a Text');
		return false;
	}
	tObj.set({
		fontFamily: font_style
	});
	canvas.renderAll();
});

