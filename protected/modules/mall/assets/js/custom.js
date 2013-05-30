/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

ajaxChat.replaceCustomCommands = function(text, textParts) {
	switch(textParts[0]) {
      case '/myip':
         return '<span class="chatBotMessage">' + this.lang['myip'].replace(/%s/, textParts[1]) + '</span>';
      case '/charUpd':
      	 var raw=this.decodeSpecialChars( text.replace("/charUpd ","") );
      	 var data=$.parseJSON(raw);
         return '<span class="chatBotMessage">'
         	+this.lang['charUpd']
         		.replace("$user", '<a target="_blank" href="/user/'+data.uID+'">'+data.user+'</a>')
         		.replace("$char",'<a target="_blank" href="/char/'+data.cID+'">'+data.cname+'</a>') 
         	+'</span>';
      case '/charCrd':
      	 var raw=this.decodeSpecialChars( text.replace("/charCrd ","") );
      	 var data=$.parseJSON(raw);
         return '<span class="chatBotMessage">'
         	+this.lang['charCrd']
         		.replace("$user", '<a target="_blank" href="/user/'+data.uID+'">'+data.user+'</a>')
         		.replace("$char",'<a target="_blank" href="/char/'+data.cID+'">'+data.cname+'</a>') 
         	+'</span>';
      case "/switchChar":
      	 var raw=this.decodeSpecialChars( text.replace("/switchChar ","") );
      	 var data=$.parseJSON(raw);
      	 console.log(this.formatText(data.new));
         return '<span class="chatBotMessage">'
         	+this.lang['switchChar']
         		.replace("$user", this.formatText(data.old))
         		.replace("$char", this.formatText(data.new)) 
         	+'</span>';   
      default:
         return text;
   }
}

ajaxChat.getCustomUserMenuItems = function(encodedUserName, userID) {
	var t="";
	if(encodedUserName == this.encodedUserName)
	//	t += '<li><a href="javascript:ajaxChat.sendMessageWrapper(\'/reset\')">'+this.lang['reset']+'</a></li>';
	//t += '<li><a target="_blank" href="/chars/'+userID+'">'+this.lang['chars']+'</a></li>';
	t += '<li><a target="_blank" href="/user/'+userID+'">'+this.lang['profile']+'</a></li>';
	return t;
}

ajaxChat.parseCustomInputCommand = function(text, textParts) {
	switch(textParts[0]) {
	  case "//":
	  	 var text = "(( "+text.replace(/\/\//, '')+" ))";
		 if(text && ajaxChat.settings['persistFontColor'] && ajaxChat.settings['fontColor']) {
		 	text = ajaxChat.assignFontColorToMessage(text);
		 }
     	 return text;
	  	 break;
	  default:
	  	return text;
	  	break;
	}
}
ajaxChat.customOnNewMessage = function(dateObject, userID, userName, userRole, messageID, messageText, channelID, ip) {
		return true;
	}
ajaxChat.formatText = function(input) {
	var text = input;
	text = this.replaceHyperLinks(text);
	text = this.replaceBBCode(text);
	text = this.replaceEmoticons(text);
	return text;
}
ajaxChat.replaceCommandNick = function(textParts) {
	return	'<span class="chatBotMessage">'
			+ this.lang['nick'].replace(/%s/, this.formatText(textParts[1])).replace(/%s/, this.formatText(textParts[2]))
			+ '</span>';		
}