@props(['id', 'title', 'inputName', 'inputId', 'inputLabel', 'button', 'route', 'method' => 'post', 'formId' => ''])
<div class="create-topic hidden pages" id="{{ $id }}">
    <div class="overlay"
        onclick="this.parentNode.classList.add('hidden');window.sessionStorage.removeItem('topic');window.sessionStorage.removeItem('edit-topic')">
    </div>
    <div class="content">
        <div class="title">
            {{ $title }}
        </div>
        <form class="create">
            <x-form-control name="{{ $inputName }}" type="link" value="{{ old($inputName) }}"
                id="{{ $inputId }}" label="{{ $inputLabel }}" />
            <div class="buttons">
                <x-button type='button' label='Cancle'
                    onclick="document.getElementById('{{ $id }}').classList.add('hidden');window.sessionStorage.removeItem('topic');window.sessionStorage.removeItem('edit-topic');" />
                <x-button label="{{ $button }}" type='button' onclick="addLink(this)" id="add-classwork-link" />
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('input-classwork-link').oninput = function() {
        if (isValidUrl(this.value)) {
            document.querySelector('button#add-classwork-link').classList.add('active');
        } else {
            document.querySelector('button#add-classwork-link').classList.remove('active');
        }
    }

    function addLink(e) {
        const videoContainer = document.getElementById("classwork-links-attah")
        const videoId = getVideoIdFromLink(document.getElementById('input-classwork-link').value);
        e.parentNode.parentNode.parentNode.parentNode.classList.add('hidden');
        if (videoId) {
            const iframe = createVideoIframe(videoId);
            videoContainer.innerHTML = '';
            videoContainer.appendChild(iframe);
            videoModal.show();
        }
        // document.getElementById("classwork-links-attah").innerHTML += `
        // <iframe src="${document.getElementById('input-classwork-link').value}" frameborder="0"></iframe>
        // `;
    }

    function isValidUrl(string) {
        try {
            new URL(string);
        } catch (_) {
            return false;
        }
        return true;
    }

    function getVideoIdFromLink(link) {
        // Extract video ID from the YouTube link
        const regex = /(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/;
        const match = link.match(regex);
        return match ? match[1] : null;
    }

    function createVideoIframe(videoId) {
        const iframe = document.createElement('iframe');
        iframe.width = '150';
        iframe.height = '80';
        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=0&controls=1&showinfo=0&rel=0`;
        iframe.frameborder = '0';
        iframe.allowfullscreen = true;
        return iframe;
    }
</script>
