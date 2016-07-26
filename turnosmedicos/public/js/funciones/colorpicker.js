$(document).ready(function(){
    $("#cp2").colorpicker({color: null,
        format: "hex",
        colorSelectors: {
              'default': '#777777',
              'primary': '#337ab7',
              'success': '#5cb85c',
              'info': '#5bc0de',
              'warning': '#f0ad4e',
              'danger': '#d9534f'
          }
    });
});