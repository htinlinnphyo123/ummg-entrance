$(document).ready(function() {
    $("#exam-type").change(function() {
        const id = $(this).val(); // Get the selected value
        $("#container-sub5").show();
        $("#container-sub6").show();
        if (id === "BEHS") { // BEHS
            $("#lab-sub-1").text('Myanmar');
            $("#lab-sub-2").text('English');
            $("#lab-sub-3").text('Math');
            $("#lab-sub-4").text('Physics');
            $("#lab-sub-5").text('Chemistry');
            $("#lab-sub-6").text('Biology');
        } else if (id === "BECA") { // BECA
            $("#lab-sub-1").text('Myanmar');
            $("#lab-sub-2").text('English');
            $("#lab-sub-3").text('Math');
            $("#lab-sub-4").text('Physics');
            $("#lab-sub-5").text('Chemistry');
            $("#lab-sub-6").text('Biology');
        } else if (id === "GED") { // GED
            $("#lab-sub-1").text('Social');
            $("#lab-sub-2").text('RLA');
            $("#lab-sub-3").text('Maths');
            $("#lab-sub-4").text('Science');
            $("#lab-sub-5").text('');
            $("#lab-sub-6").text('');
            $("#container-sub5").hide();
            $("#container-sub6").hide();
        } else if (id === "IGCSE") { // IGCSE
            $("#lab-sub-1").text('English');
            $("#lab-sub-2").text('Math');
            $("#lab-sub-3").text('Physics');
            $("#lab-sub-4").text('Chemistry');
            $("#lab-sub-5").text('Biology');
            $("#lab-sub-6").text('X');
        }
    });
});