$(document).ready(initialisePage);

function initialisePage()
{
  // Check if the functions are defined before assigning them as event handlers
  if (typeof handleNiceAutoComplete === "function") {
    $("#search1").keyup(function() {
      handleNiceAutoComplete('searchForm1', 'searchByName');
    });
  }

  if (typeof handleKeyPress === "function") {
    $("#search2").keyup(function(event) {
      handleKeyPress(event, 'searchForm2');
    });
    $("#search3").keyup(function(event) {
      handleKeyPress(event, 'searchForm3');
    });
    $("#search4").keyup(function(event) {
      handleKeyPress(event, 'searchForm4');
    });
    $("#search5").keyup(function(event) {
      handleKeyPress(event, 'searchForm5');
    });
  }
}

function handleNiceAutoComplete(formId, searchParam) {
    var searchVal = $("#" + formId + " input[name=" + searchParam + "]").val();
    var search = searchVal ? searchVal.trim() : "";
    if (search != "") {
        $.get("../../cheese/model/getCheese_service.php?" + searchParam + "=" + search, function(results) {
            
            $("#" + formId + " input[name=" + searchParam + "]").autocomplete({
                source: results
            });
        });
    } else {
        $("#" + formId + " div.results").hide();
    }
}


function niceAutoCompleteCallback(results, formId) {
    console.log(results);
    $("#" + formId + " div.results").empty();
    for (var i = 0; i < results.length; i++) {
        var result = $('<div class="result">' + results[i] + '</div>');
        result.click(function () {
            $("#" + formId + " div.results").hide();
            $("#" + formId + " input[name=searchname]").val($(this).text());
            $("#" + formId).get(0).submit();
        });
        $("#" + formId + " div.results").append(result);
    }
    if (results.length == 0) {
        $("#" + formId + " div.results").hide();
    } else {
        $("#" + formId + " div.results").show();
    }
}