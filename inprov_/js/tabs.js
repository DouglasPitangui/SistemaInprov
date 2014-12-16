/*
 Product Name:	XTabs
 Version:		1.0
 Dated:			25-May-2006
 Author:			Khurram Ali Rasheed
 Company:		Xtreme Technologies
 URL:			http://www.magneticwebby.com/KhurramAR/
 Email:			khurram_a_r@hotmail.com
 
 Tested on Browsers:
 1- IE 6
 2- Firefox 1.5.0.3
 
 Please report about any inconvinience, do not hesitate for any help.
 If you need something more in it, please contact on my email address.
 Any suggessions will be appriciated, and considered to proceed on.
 
 CODE RIGHTS:
 This is an open source product, you can use it in your web applications,
 but can not make any change to this code, and can not redistribute this
 product.
 
 Thanks for using XTabs V1.0
 */

function XTabs(obj, //Handler to object
        initTab, //Tab to be selected initiallly			   
        sepWidth, //Width between tabs			   
        initSep, //Start from separator if true
        bigActive, //if true active tab will be little big.

        useImages, //must be true if you want to use images as tab representation
        imagesPath, //Path to images folder		   

        bc, //border color

        bgc, //active background color
        tc, //text color for active tab

        ibgcout, //inactive background color onmouseout
        itcout, //text color for inactive tab out

        ibgcover, //inactive background color onmouseover *THIS PROPERTY IS NOT IN USE YET*
        itcover, //text color for inactive tab over *THIS PROPERTY IS NOT IN USE YET*

        ss			//Style Sheet Used
        ) {
    this.obj = (obj) ? obj : "xtremetab";
    this.objTab = "tab_" + obj;
    this.sepWidth = (typeof sepWidth != 'undefined') ? ((sepWidth > 0) ? sepWidth : '1') + 'px' : '2px';
    this.initTabSelected = (typeof initTab != 'undefined') ? ((initTab > 0) ? initTab : 1) : 1;
    this.initSeparator = (initSep) ? initSep : false;
    this.activeBig = (bigActive) ? ((bigActive == true) ? "_big" : "") : "";

    this.useImages = (typeof useImages != "undefined") ? useImages : true;
    this.imagesPath = (imagesPath) ? imagesPath : "";

    this.borderColor = (bc) ? bc : "#000000";
    this.aBgc = (bgc) ? bgc : "#ffffff";
    this.aTc = (tc) ? tc : "#000000";
    this.iBgcOut = (ibgcout) ? ibgcout : "#cccccc";
    this.iTcOut = (itcout) ? itcout : "#000000";
    this.iBgcOver = (ibgcover) ? ibgcover : "#ffffff";
    this.iTcOver = (itcover) ? itcover : "#000000";

    this.lastCell = null;
    this.stylesheet = (ss) ? ss : "silver_green";



    /////////////////////////
    this.tabheader = "<table class='headerTab' cellspacing='0' cellpadding='0' border='0' id='tabheader_" + this.obj + "'><tr></tr></table>";
    this.tabsSet = new Array();
    /////////////////////////
    this.state = 1;
}
;

XTabs.prototype.initTabs = function(w, h) {
    if (this.state != 1)
        return;

    if (h) {
        if (!parseInt(h)) {
            alert("Invalid argument in height. Height must be provided in exact figures.\neg. 500\nXTabs can not initiated successfully.")
            return;
        }
    }

    startTable = "<table width='" + w + "' cellspacing='0' cellpadding='0'><tr><td>";
    this.rHeight = h ? h : 0;
    document.write(startTable);
    document.write(this.tabheader);
    if (this.initSeparator) {
        TabHeader = document.getElementById("tabheader_" + this.obj);
        cell = TabHeader.rows[0].insertCell(TabHeader.rows[0].cells.length);
        cell.innerHTML = "<img src='" + this.imagesPath + "images/spacer.gif' style='width:" + this.sepWidth + "'>"
        cell.className = 'tabSeparator'
        cell.style.borderColor = this.borderColor;
        this.lastCell = cell;
    }
    this.state = 2;
}

XTabs.prototype.endTabs = function() {
    if (this.state != 2)
        return;

    initTab = (this.initTabSelected <= this.tabsSet.length) ? this.initTabSelected : this.tabsSet.length;
    this.setTab(initTab);
    this.lastCell.width = "100%";
    endTable = "</td></tr></table>";
    document.write(endTable);
}


XTabs.prototype.addTab = function(value, paneId, title, icon) {
    if (this.state != 2)
        return;

    value = (typeof value != 'undefined') ? value : "";
    title = (typeof title != 'undefined') ? title : "";
    icon = (typeof icon != 'undefined') ? icon : "";
    if (icon.length > 0)
        if (Client.Browser.IsIE())
            iconString = "<img align='absmiddle' src='" + icon + "'> ";
        else
            iconString = "<img align='top' src='" + icon + "'> ";
    else
        iconString = "";

    refId = this.tabsSet.length + 1;

    str = ""
    str += "<table cellspacing='0' cellpadding='0' onclick='" + this.obj + ".setTab(" + refId + ")' border='0' id='" + this.objTab + "_" + refId + "' title='" + title + "'>"
    str += "<tr>"
    if (this.useImages) {
        str += "<td nowrap class='a_tab_l" + this.activeBig + "'></td>"
        str += "<td nowrap class='a_tab_m" + this.activeBig + "' valign='middle'>" + iconString + value + "</td>"
        str += "<td nowrap class='a_tab_r" + this.activeBig + "'></td>"
    }
    else {
        str += "<td nowrap class='active_tab" + this.activeBig + "' valign='middle'>" + iconString + value + "</td>"
    }
    str += "</tr>"
    str += "</table>"

    TabHeader = document.getElementById("tabheader_" + this.obj);
    cell = TabHeader.rows[0].insertCell(TabHeader.rows[0].cells.length);
    cell.className = "headerTabCell"
    cell.innerHTML = str;

    //Add seperator
    cell = TabHeader.rows[0].insertCell(TabHeader.rows[0].cells.length);
    cell.innerHTML = "<img src='" + this.imagesPath + "images/spacer.gif' style='width:" + this.sepWidth + "'>"
    cell.className = 'tabSeparator'
    cell.style.borderColor = this.borderColor;
    this.lastCell = cell;
    /////////////////////

    cInd = this.tabsSet.length;
    this.tabsSet[cInd] = new Array();
    this.tabsSet[cInd][0] = refId;
    this.tabsSet[cInd][1] = paneId;
    this.tabsSet[cInd][2] = this.objTab + "_" + refId;

}
XTabs.prototype.setTab = function(id) {

    for (i = 0; i < this.tabsSet.length; i++)
    {
        pane = document.getElementById(this.tabsSet[i][1]);
        tab = document.getElementById(this.tabsSet[i][2]);
        pane.style.height = this.rHeight;

        if (this.tabsSet[i][0] == id) {
            pane.style.display = "block";
            pane.className = 'xPane';
            pane.style.borderColor = this.borderColor;

            if (!this.useImages) {
                tab.rows[0].cells[0].className = "active_tab tab_w" + this.activeBig;
                tab.rows[0].cells[0].style.backgroundColor = this.aBgc;
                tab.rows[0].cells[0].style.color = this.aTc;
            }
            else {
                tab.rows[0].cells[0].className = "a_tab_l" + this.activeBig;
                tab.rows[0].cells[1].className = "a_tab_m" + this.activeBig;
                tab.rows[0].cells[2].className = "a_tab_r" + this.activeBig;
            }
        }
        else {
            pane.style.display = "none"

            if (!this.useImages) {
                tab.rows[0].cells[0].className = "inactive_tab_out tab_w";
                tab.rows[0].cells[0].style.borderColor = this.borderColor;
                tab.rows[0].cells[0].style.backgroundColor = this.iBgcOut;
                tab.rows[0].cells[0].style.color = this.iTcOut;
            }
            else {
                tab.rows[0].cells[0].className = "i_tab_l";
                tab.rows[0].cells[1].className = "i_tab_m";
                tab.rows[0].cells[2].className = "i_tab_r";

                tab.rows[0].cells[0].innerHTML = "<img src='" + this.imagesPath + "images/spacer.gif'>";
                tab.rows[0].cells[2].innerHTML = "<img src='" + this.imagesPath + "images/spacer.gif'>";

                tab.rows[0].cells[0].style.borderColor = this.borderColor;
                tab.rows[0].cells[1].style.borderColor = this.borderColor;
                tab.rows[0].cells[2].style.borderColor = this.borderColor;
            }
        }
    }

}

XTabs.prototype.copyAttributes = function(obj) {

    this.sepWidth = obj.sepWidth;
    this.initTabSelected = obj.initTabSelected;
    this.initSeparator = obj.initSeparator;
    this.activeBig = obj.activeBig;

    this.useImages = obj.useImages;
    this.imagesPath = obj.imagesPath;

    this.borderColor = obj.borderColor;
    this.aBgc = obj.aBgc;
    this.aTc = obj.aTc;
    this.iBgcOut = obj.iBgcOut;
    this.iTcOut = obj.iTcOut;
    this.iBgcOver = obj.iBgcOver;
    this.iTcOver = obj.iTcOver;

    this.stylesheet = obj.stylesheet;
}

RegisterNamespaces("Client.Browser");
if (!Client.Browser.IsMozilla)
{
    Client.Browser.IsMozilla = function()
    {
        return false;
    };
}
nav = navigator.userAgent;

Client.Browser._IsNetscape = (nav.indexOf("Netscape") > -1) ? true : false;
Client.Browser._IsOpera = (nav.indexOf("Opera") > -1) ? true : false;
Client.Browser._IsFireFox = (nav.indexOf("Firefox") > -1) ? true : false;
Client.Browser._IsIE = !Client.Browser._IsNetscape && !Client.Browser._IsOpera && !Client.Browser._IsFireFox;

Client.Browser.IsNetscape = function()
{
    return Client.Browser._IsNetscape;
};
Client.Browser.IsOpera = function()
{
    return Client.Browser._IsOpera;
};
Client.Browser.IsFireFox = function()
{
    return Client.Browser._IsFireFox;
};
Client.Browser.IsIE = function()
{
    return Client.Browser._IsIE;
};

function RegisterNamespaces()
{
    for (var i = 0;
            i < arguments.length; i++)
    {
        var astrParts = arguments[i].split(".");
        var root = window;
        for (var j = 0;
                j < astrParts.length; j++)
        {
            if (!root[astrParts[j]])
                root[astrParts[j]] = new Object();
            root = root[astrParts[j]];
        }
    }
}