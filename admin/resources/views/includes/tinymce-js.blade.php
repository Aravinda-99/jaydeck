
<script src="{{url('assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>tinymce.init({ selector:'.tinymce',
    plugins: "lists preview print textcolor colorpicker emoticons hr table charmap code link" ,
    themes: "modern",
    toolbar1: "forecolor backcolor emoticons charmap  table undo redo code ",
    toolbar2: "alignleft aligncenter alignright alignjustify  bullist numlist outdent indent tyleselect ",
    toolbar3: "bold italic  tyleselect formatselect fontselect fontsizeselect  link",


    style_formats: [
    {
      title: 'testt',
      selector: 'a',
      styles: {
        'color': '#fff',
        'background-color': '#5bc0de',
        'border-color': '#5bc0de',
            'display': 'inline-block',
    'padding': '6px 12px',
    'margin-bottom': '0',
    'font-size': '14px',
    'font-weight': '400',
    'line-height': '1.42857143',
    'text-align': 'center',
    'white-space': 'nowrap',
    'vertical-align': 'middle',
    '-ms-touch-action': 'manipulation',
    'touch-action': 'manipulation',
    'cursor': 'pointer',
    '-webkit-user-select': 'none',
    '-moz-user-select': 'none',
    '-ms-user-select': 'none',
    'user-select': 'none',
    'background-image': 'none',
    'border': '1px solid transparent',
    'border-radius': '4px',
    'text-decoration':'none'
      }
    },
    {
      title: 'Image Right',
      selector: 'img',
      styles: {
        'float': 'right',
        'margin': '0 0 10px 10px'
      }
    }
  ]
    });</script>
