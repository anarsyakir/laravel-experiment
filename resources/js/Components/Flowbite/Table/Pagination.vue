<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
   links: Object,
   meta: Object 
});

const reformatUrl = (url) => {
    const queryString = window.location.search;
    const queryParams = new URLSearchParams(queryString);
    const queryParamsObject = {};
    queryParams.forEach((value, key) => {
        queryParamsObject[key] = value;
    });

    if (queryParamsObject.hasOwnProperty('search_text')){
        return url + '&search_text=' + queryParamsObject['search_text']
    }

    return url;
}

</script>

<template>
    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
        aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">{{ meta.from + '-' + meta.to }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ meta.total }}</span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li v-for="link in meta.links">
                <Link v-if="link.label.includes('Previous')" :href="link.url ? reformatUrl(link.url) : '#'"
                    :class="(!link.url ? 'opacity-25 cursor-not-allowed ' : '') + 'flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </Link>
                <Link v-else-if="link.active" :href="reformatUrl(link.url)"
                    aria-current="page"
                    class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                    {{ link.label }}
                </Link>
                <Link v-else-if="link.label.includes('Next')" :href="link.url ? reformatUrl(link.url) : '#'"
                    :class="(!link.url ? 'opacity-25 cursor-not-allowed ' : '') + 'flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </Link>
                <Link v-else :href="reformatUrl(link.url)"
                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {{ link.label }}
                </Link>
            </li>
        </ul>
    </nav>
</template>