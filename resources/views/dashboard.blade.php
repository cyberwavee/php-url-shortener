<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="url_shortener_form">
                    @csrf
                        <div>
                            <x-label for="long_url" :value="__('URL link')" />
                            <x-input id="long_url" class="block mt-1 w-full" type="text" name="long_url" required/>
                        </div>

                        <div>
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" required/>
                        </div>

                        <div>
                            <x-label for="tags" :value="__('Tags')" />
                            <x-input id="tags" class="block mt-1 w-full" type="text" name="tags"/>
                        </div>

                        <div class="flex items-center justify-end mt-auto">
                            <x-button class="ml-3">
                                {{ __('Shorten link') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="container url_result" style="visibility: hidden">
                        <x-label for="short_url"/>
                        <x-input id="short_url" class="block mt-1 w-full" type="text" name="short_url" onclick="copyToClipboard('short_url')" :value="__('Short link')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        $('#url_shortener_form').on('submit',function(event){
            event.preventDefault();
            let long_url = $('#long_url').val();
            let title = $('#title').val();
            let tags = $('#tags').val();

            $.ajax({
                url: "/api/links",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    long_url: long_url,
                    title: title,
                    tags: tags,
                },
                success:function(response){
                    $(".url_result").css("visibility", "visible");
                    $('#short_url').val(response.data.url);
                },
            });
        });

        let addrsField = $('#short_url');
        function copyToClipboard(id) {
            document.getElementById(id).select();
            document.execCommand('copy');

            addrsField.addClass('flashBG')
                .delay('1000').queue(function(){
                addrsField.removeClass('flashBG').dequeue();
            });
        }
    </script>
</x-app-layout>
