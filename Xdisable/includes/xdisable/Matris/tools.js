// MS-Dose View by Mahdi HosseinZade[Arshen]
function startTicker() {theCurrentStory = -1;theCurrentLength = 0;if (document.getElementById) {theAnchorObject = document.getElementById("TickerLink");runTheTicker();} else { return true; } }
function runTheTicker() {var myTimeout;try {if(theCurrentLength == 0) {theCurrentStory++;theCurrentStory = theCurrentStory % theItemCount;theStorySummary = theSummaries[theCurrentStory].replace(/&quot;/g,'"');theTargetLink = theSiteLinks[theCurrentStory];theAnchorObject.href = "";thePrefix = "";}}
catch(err){}theAnchorObject.innerHTML = thePrefix +theStorySummary.substring(0,theCurrentLength) + whatWidget();
if(theCurrentLength != theStorySummary.length1) {theCurrentLength++;myTimeout = theCharacterTimeout;} else {theCurrentLength = 0;myTimeout = theStoryTimeout;}setTimeout("runTheTicker()", myTimeout);}
function whatWidget() {if(theCurrentLength == theStorySummary.length) {return theWidgetNone;}if((theCurrentLength % 2) == 1) {return theWidgetOne;} else {return theWidgetTwo;}}