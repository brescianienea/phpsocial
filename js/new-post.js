$(document).ready(function () {
    $('.se-wrapper-code').attr('name', 'content');
});

$('#title').on("keyup", function () {

    if ($('#title').val() === '' || $('#game_tag').val() === '' || $('#tenor_tag').val() === '') {
        $(".submit").prop('disabled', true);
    } else {
        $(".submit").prop('disabled', false);
    }
});

$('#game_tag').on("change", function () {

    if ($('#title').val() === '' || $('#game_tag').val() === '' || $('#tenor_tag').val() === '') {
        $(".submit").prop('disabled', true);
    } else {
        $(".submit").prop('disabled', false);
    }
})
;

$('#tenor_tag').on("change", function () {

    if ($('#title').val() === '' || $('#game').val() === '' || $('#tenor_tag').val() === '') {
        $(".submit").prop('disabled', true);
    } else {
        $(".submit").prop('disabled', false);
    }
});


$('form').submit(function (e) {
    e.preventDefault();
    $('.se-wrapper-code').val(editor.getContents());
    $.ajax({

        method: "POST",
        url: "/query/post/addPost.php",
        data: $('form').serialize(),
        success: function (data) {
            console.log(data);
            let result = JSON.parse(data);
            if (result['message'] === 'success') {
                window.location.href = "profile-page.php?section=profile";
                alert('Posted.');
            } else {
                alert(result['message']);
            }


        }

    });


});

const editor = SUNEDITOR.create((document.getElementById('writer') || 'writer'), {
    mode: 'classic',
    rtl: false,
    resizingBar: false,
    resizeEnable: false,
    formats: [
        'p',
        'blockquote',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6'
    ],
    imageResizing: false,
    imageHeightShow: false,
    imageAlignShow: false,
    imageWidth: '100%',
    imageMultipleFile: true,
    videoResizing: false,
    videoHeightShow: false,
    videoAlignShow: false,
    videoFileInput: false,
    videoRatioShow: false,
    youtubeQuery: 'autoplay=0',
    audioUrlInput: false,
    tabDisable: false,
    lineHeights: [
        {
            text: 'Single',
            value: 1
        },
        {
            text: 'Double',
            value: 2
        }
    ],
    paragraphStyles: [
        'spaced',
        {
            name: 'Box',
            class: '__se__customClass'
        }
    ],
    placeholder: 'Write your post',
    mediaAutoSelect: false,
    linkTargetNewWindow: true,
    buttonList: [
        [
            'undo',
            'redo',
            'blockquote',
            'bold',
            'underline',
            'italic',
            'strike',
            'subscript',
            'superscript',
            'removeFormat',
            'outdent',
            'indent',
            'align',
            'list',
            'lineHeight',
            'link',
            'image',
            'video'
        ]
    ]
}, {});