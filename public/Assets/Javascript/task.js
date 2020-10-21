$(document).ready(function () {

    var selectedCharacters = new Map();
    getCharacters();


    $(".card").on("click", function (e) {
        var name = $(e.delegateTarget).find("h4").text();

        if (selectedCharacters.has(name)) {
            selectedCharacters.delete(name);
            $(e.delegateTarget).find(".card-body").removeClass("bg-success");
        }
        else {
            if(selectedCharacters.size < 3) {
                selectedCharacters.set(name, characters.get($.trim(name)));
                $(e.delegateTarget).find(".card-body").addClass("bg-success");
            }
            if (selectedCharacters.size == 3) {
                $("#download").prop("disabled", false);
                $("#download").removeClass("disabled");
            }
        }
        if (selectedCharacters.size < 3) {
            $("#download").prop("disabled", true);
            $("#download").addClass("disabled");
            }
        setText();

    });

    function setText() {
        var selectionText = [...selectedCharacters.keys()].toString();;
        if (selectionText.length == 0) {
            $("#selectionText").text("SELECT 3 CHARACTERS!");
        }
        else {
            $("#selectionText").text("You have selected " + selectionText);
        }
    }

    $("#download").on("click", function (e) {
        var characterData = [];
        var itr = selectedCharacters.values();
        for (i = 0; i < selectedCharacters.size; i++) {
            characterData.push(Object.values(itr.next().value));
        }

        for (let i = 0; i < characterData.length; i++) {
            for (let j = 0; j < characterData[i].length; j++) {
                if (typeof characterData[i][j] == typeof {}) {
                    characterData[i][j] = characterData[i][j].toString();
                }

            }

        }
        $.ajax({
            type:"POST",
            url: "/Home/download",
            data: {characterData: characterData },

        });
    });

    $("#reset").on("click", function (e) {
        selectedCharacters = new Map();
        $("div").removeClass("bg-success");
        $("#download").prop("disabled", true);
        $("#download").addClass("disabled");
        setText();

    });
});

var characters = new Map();
function getCharacters() {
    Object.values(charactersJSON).forEach(character => {
        characters.set(character.name, character);
    });

}