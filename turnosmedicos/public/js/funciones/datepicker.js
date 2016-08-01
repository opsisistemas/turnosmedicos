$(document).ready(function() {
    $(".datepicker").datepicker({dateFormat: 'd-m-Y'}).val();
    $(".calendarpicker").datepicker({inline: true, sideBySide: true});
});