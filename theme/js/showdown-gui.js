// Rewrite and cutdown to my needs of https://github.com/coreyti/showdown/blob/master/example/showdown-gui.js
// showdown-gui.js
//
// A sample application for Showdown, a javascript port
// of Markdown.
//
// Copyright (c) 2007 John Fraser.
//
// Redistributable under a BSD-style open source license.
// See license.txt for more information.
//
// The full source distribution is at:
//
//				A A L
//				T C A
//				T K B
//
//   <http://www.attacklab.net/>
//

window.onload = startGui;

var converter;
var convertTextTimer,processingTime;
var lastText,lastOutput,lastRoomLeft;
var inputPane,previewPane;
var maxDelay = 3000; // longest update pause (in ms)

function startGui() {
	inputPane = document.getElementById("inputPane");
	previewPane = document.getElementById("previewPane");

	window.onkeyup = inputPane.onkeyup = onInput;

	var pollingFallback = window.setInterval(function(){
		if(inputPane.value != lastText)
			onInput();
	},1000);

	inputPane.onpaste = function() {
		if (pollingFallback!=undefined) {
			window.clearInterval(pollingFallback);
			pollingFallback = undefined;
		}
		onInput();
	}

	if (inputPane.addEventListener)
		inputPane.addEventListener("input",inputPane.onpaste,false);

	converter = new Showdown.converter();
	convertText();
	inputPane.focus();
	previewPane.scrollTop = 0;
}


function convertText() {
	var text = inputPane.value;
	
	if (text && text == lastText)
		return;
	else
		lastText = text;

	var startTime = new Date().getTime();
	text = converter.makeHtml(text);
	var endTime = new Date().getTime();	
	processingTime = endTime - startTime;

	saveScrollPositions();
	previewPane.innerHTML = text;
	lastOutput = text;
	restoreScrollPositions();
};

function onInput() {
	if (convertTextTimer) {
		window.clearTimeout(convertTextTimer);
		convertTextTimer = undefined;
	}

		var timeUntilConvertText = 0;

		timeUntilConvertText = processingTime;

		if (timeUntilConvertText > maxDelay)
			timeUntilConvertText = maxDelay;

		convertTextTimer = window.setTimeout(convertText,timeUntilConvertText);
}

var previewScrollPos;
var outputScrollPos;

function getScrollPos(element) {
	if (element.scrollHeight <= element.clientHeight)
		return 1.0;
	return element.scrollTop/(element.scrollHeight-element.clientHeight);
}

function setScrollPos(element,pos) {
	element.scrollTop = (element.scrollHeight - element.clientHeight) * pos;
}

function saveScrollPositions() {
	previewScrollPos = getScrollPos(previewPane);
}

function restoreScrollPositions() {
	previewPane.scrollTop = previewPane.scrollTop;
	setScrollPos(previewPane,previewScrollPos);
}

