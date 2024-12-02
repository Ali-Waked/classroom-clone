@props(['id', 'title', 'inputName', 'inputId', 'inputLabel', 'button', 'route', 'method' => 'post', 'formId' => ''])
<div class="create-topic hidden pages" id="{{ $id }}">
    <div class="overlay"
        onclick="this.parentNode.classList.add('hidden');window.sessionStorage.removeItem('topic');window.sessionStorage.removeItem('edit-topic')">
    </div>
    <div class="content">
        <div class="title">
            {{ $title }}
        </div>
        <form action="{{ $route }}" id="{{ $formId }}" method="post" class="create">
            @csrf
            @method($method)
            <x-form-control name="{{ $inputName }}" value="{{ old($inputName) }}" id="{{ $inputId }}"
                label="{{ $inputLabel }}" />
            <div class="buttons">
                <x-button type='button' label='Cancle'
                    onclick="document.getElementById('{{ $id }}').classList.add('hidden');window.sessionStorage.removeItem('topic');window.sessionStorage.removeItem('edit-topic');" />
                <x-button label="{{ $button }}" />
            </div>
        </form>
    </div>
</div>
