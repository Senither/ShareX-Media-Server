<p class="pt-8 mb-4 col-span-6 text-center dark:text-dark-gray-400">
    You don't have any {{ $type }} uploads right now, create an
    <a class="text-indigo-700 dark:text-indigo-400" href="{{ route('api-tokens.index') }}">
        API token
    </a>
    to start uploading {{ Str::plural($type) }}.
</p>

<p class="pb-8 col-span-6 text-center dark:text-dark-gray-400">
    You can find guides for how to setup ShareX to use your API tokens on the
    <a class="text-indigo-700 dark:text-indigo-400" target="blank" href="https://github.com/Senither/ShareX-Media-Server/wiki/Setting-up-ShareX">
        project wiki page
    </a>.
</p>
