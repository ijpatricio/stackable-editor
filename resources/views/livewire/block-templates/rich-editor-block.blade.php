<div>
    <div x-data="{
        content: @js(data_get($block_data, 'content'))
    }">
        <div x-html="content"></div>
    </div>

    <div>
        Fi
    </div>

    {!! data_get($block_data, 'content') !!}

</div>
