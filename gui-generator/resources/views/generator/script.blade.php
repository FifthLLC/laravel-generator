<script type="application/javascript">
    let element = document.getElementById('addField');
    element.addEventListener('click', () => {
        let sample = document.querySelector('[data-name=field]');
        let clonedElement = sample.cloneNode(true);
        prepareInputs(clonedElement);
        sample.parentNode.appendChild(clonedElement);
    });

    let table = document.getElementById('modelTable');
    table.addEventListener('click', (event) => {
        if(event.target.getAttribute('data-action') === 'deleteRaw') {
            deleteRaw(event.target);
        }
    });

    function deleteRaw(item) {
        let node = getParentRaw(item);
        if(node) {
            node.parentNode.removeChild(node);
        }
    }

    function getParentRaw(item) {
        if(item.tagName === 'TR') {
            return item;
        }

        if(item.tagName === 'BODY') {
            return null;
        }

        return getParentRaw(item.parentNode);
    }

    function prepareInputs(element) {
        let inputs = element.querySelectorAll('input, select');
        inputs.forEach(input => {
            if(input.tagName !== 'SELECT') {
                if(input.type === 'checkbox') {
                    input.checked = false;
                } else {
                    input.value = null;
                }
            }

            input.name = input.name.replace(0, Array.from(document.querySelectorAll('[data-name=field]')).length);
        })
    }
</script>
