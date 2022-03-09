<script>

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('textarea').forEach(el => {
            el.style.height = "5px";
            el.style.height = (el.scrollHeight)+"px";
        })
    })

    let template = document.querySelector('#image_template'),
        image_wrapper = document.querySelector('#image_wrapper');

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

    function show_preview(evt){
        if (evt.target.files.length > 0) {
            var preview = URL.createObjectURL(evt.target.files[0]);
            evt.target.parentNode.querySelector('img.preview').src = preview;
        }
    }

    function add_image() {
        let img = document.createElement('div');
        
        img.innerHTML = template.innerHTML.replace(/IMAGEID/g, Date.now());
        image_wrapper.appendChild(img);
    }

    function remove_image(evt){
        let target = evt.target.closest('.image');
        target.parentNode.removeChild(target);
    }

</script>