var Url = {

    // public method for url encoding   
    Encode: function(string) {
        return escape(this._utf8_encode(string));
    },

    // public method for url decoding   
    Decode: function(string) {
        return this._utf8_decode(unescape(string));
    },

    // private method for UTF-8 encoding   
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding   
    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}  

function SearchBox(resultUrl, wordsMode, catalogue, textId, btnId) {
    this.ResultUrl = resultUrl;
    this.WordsMode = wordsMode;
    this.Catalogue = catalogue;
    this.TextId = textId;
    this.BtnId = btnId;
    this.TextCtrl = null;
    this.BtnCtrl = null;
    
    var instance = this;  
	instance.InitializeHandler = function() {instance.Initialize();};
	if (document.all && window.attachEvent) {	
		window.attachEvent("onload", this.InitializeHandler);
	} 
	else if (document.addEventListener) {
        window.addEventListener("load", this.InitializeHandler, false);
	}
}

SearchBox.Create = function (resultUrl, wordsMode, catalogue, textId, btnId) {
    if (typeof(searchBox) == "undefined") {
        searchBox = new Array();
    }
    
    searchBox[textId] = new SearchBox(resultUrl, wordsMode, catalogue, textId, btnId);
}

SearchBox.prototype.GotoResult = function (e) 
{
    if (!e) {
	    var e = event;
    }
    if (e.stopPropagation) { 
        e.stopPropagation(); 
    }
    else {
        e.cancelBubble = true;
    }  
    if (e.preventDefault) {
        e.preventDefault(); 
    }
    else {
        e.returnValue = false;
    }
	window.location = this.GetLocation();
}

SearchBox.prototype.GetLocation = function () 
{
    var query = this.TextCtrl.value;
    var join = (this.ResultUrl.indexOf("?") == -1) ? "?" : "&";
    var mode = (this.WordsMode != "AllWords") ? "&WordsMode=" + this.WordsMode : "";
    return this.ResultUrl + join + "IndexCatalogue=" 
	    + Url.Encode(this.Catalogue) + "&SearchQuery=" + Url.Encode(query) + mode;
}

SearchBox.prototype.KeyPress = function (e) 
{
    if (!e) {
	    var e = event;
    }
    if (e.keyCode == 13) {
        this.GotoResult(e);
    }
}

SearchBox.prototype.KeyUp = function (e) 
{
    this.BtnCtrl.href = this.GetLocation();
}

SearchBox.prototype.Initialize = function () 
{
    this.TextCtrl = document.getElementById(this.TextId);
    this.BtnCtrl = document.getElementById(this.BtnId);
    var instance = this;
	instance.KeyPressHandler = function(e) {instance.KeyPress(e);};
	instance.KeyUpHandler = function(e) {instance.KeyUp(e);};
	instance.ClickHandler = function(e) {instance.GotoResult(e);};
	if (document.all && this.TextCtrl.attachEvent) {	
		this.TextCtrl.attachEvent("onkeypress", this.KeyPressHandler);
		if (this.BtnCtrl.href) {
	        this.TextCtrl.attachEvent("onkeyup", this.KeyUpHandler);
	        this.BtnCtrl.href = this.GetLocation();
	    }
	    else {
	        this.BtnCtrl.attachEvent("onclick", this.ClickHandler);
	    }
	} 
	else if (this.TextCtrl.addEventListener) {
        this.TextCtrl.addEventListener("keypress", this.KeyPressHandler, false);
        if (this.BtnCtrl.href) {
	        this.TextCtrl.addEventListener("keyup", this.KeyUpHandler, false);
	        this.BtnCtrl.href = this.GetLocation();
	    }
	    else {
	        this.BtnCtrl.addEventListener("click", this.ClickHandler, false);
	    }
	}
}

function indexingStart() {

    var windowH = getPageSize();
    document.getElementById('searchIndexingInProcess').getElementsByTagName('div')[0].style.top = ((windowH[3])/2)+'px';
    //document.getElementById('searchIndexingInProcess').getElementsByTagName('div')[0].style.left = ((windowH[2])/2)+'px';
    document.getElementById('searchIndexingInProcess').style.display = 'block';
    document.getElementsByTagName('body')[0].className = 'searchIndexingBodyCrop';
    document.getElementById('searchIndexingInProcess').getElementsByTagName('div')[1].style.width = windowH[0]+'px';
    document.getElementById('searchIndexingInProcess').getElementsByTagName('div')[1].style.height = windowH[1]+'px';
}
function getPageSize(){

    var xScroll, yScroll;

    if (window.innerHeight && window.scrollMaxY) {    
        xScroll = window.innerWidth + window.scrollMaxX;
        yScroll = window.innerHeight + window.scrollMaxY;
    } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
        xScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
        xScroll = document.body.offsetWidth;
        yScroll = document.body.offsetHeight;
    }
    var windowWidth, windowHeight;

    //      console.log(self.innerWidth);
    //      console.log(document.documentElement.clientWidth);

    if (self.innerHeight) {   // all except Explorer
    if(document.documentElement.clientWidth){
          windowWidth = document.documentElement.clientWidth; 
    } else {
          windowWidth = self.innerWidth;
    }
        windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
        windowWidth = document.documentElement.clientWidth;
        windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
        windowWidth = document.body.clientWidth;
        windowHeight = document.body.clientHeight;
    } 
    // for small pages with total height less then height of the viewport
    if(yScroll < windowHeight){
        pageHeight = windowHeight;
    } else { 
        pageHeight = yScroll;
    }

    //      console.log("xScroll " + xScroll)
    //      console.log("windowWidth " + windowWidth)

    // for small pages with total width less then width of the viewport
    if(xScroll < windowWidth){      
        pageWidth = xScroll;        
    } else {
        pageWidth = windowWidth;
    }
    //      console.log("pageWidth " + pageWidth)
    arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
    return arrayPageSize;
}


