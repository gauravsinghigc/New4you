<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>

<script type="text/javascript">
google.load("elements", "1", {packages: "transliteration"});
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function OnLoad() {                
    var options = {
        sourceLanguage:
        google.elements.transliteration.LanguageCode.ENGLISH,
        destinationLanguage:
        [google.elements.transliteration.LanguageCode.HINDI],
        shortcutKey: 'ctrl+g',
        transliterationEnabled: true
    };

    var control = new google.elements.transliteration.TransliterationControl(options);
    control.makeTransliteratable(["txtHindi"]);
    var keyVal = 32; // Space key
    $("#txtEnglish").on('keydown', function(event) {
        if(event.keyCode === 32) {
            var engText = $("#txtEnglish").val() + " ";
            var engTextArray = engText.split(" ");
            $("#txtHindi").val($("#txtHindi").val() + engTextArray[engTextArray.length-2]);

            document.getElementById("txtHindi").focus();
            $("#txtHindi").trigger ( {
                type: 'keypress', keyCode: keyVal, which: keyVal, charCode: keyVal
            } );
        }
    });

    $("#txtHindi").bind ("keyup",  function (event) {
        setTimeout(function(){ $("#txtEnglish").val($("#txtEnglish").val() + " "); document.getElementById("txtEnglish").focus()},0);
    });
} //end onLoad function

google.setOnLoadCallback(OnLoad);
</script> 

</head>
    <body>
       English Text: <input size="40" type="text" id="txtEnglish"/> <br/>
       Hindi Text : <input size="40" type="text" id="txtHindi"/> 
</body>
</html>