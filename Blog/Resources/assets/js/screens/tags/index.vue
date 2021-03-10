<script type="text/ecmascript">
    import loadsEntries from '../loadsEntries';
    import FiltersDropdown from '../../partials/FilterDropdown.vue';

    export default {
        mixins: [loadsEntries],


        components: {
            'filters': FiltersDropdown
        },


        /**
         * The component's data.
         */
        data() {
            return {
                baseURL: '/api/tags',
                entries: [],
                hasMoreEntries: false,
                nextPageUrl: null,
                loadingMoreEntries: false,
                ready: false,
                searchQuery: ''
            };
        },


        /**
         * Prepare the component.
         */
        mounted() {
            document.title = "Tags — Wink.";

            this.loadEntries();
        },
    }
</script>

<template>
    <div>
        <page-header>
            <div slot="right-side">
                <router-link :to="{name:'tag-new'}" class="py-1 px-2 btn-primary text-sm">
                    Crear Tag
                </router-link>
            </div>
        </page-header>

        <div class="container">
            <div class="mb-10 flex items-center">
                <h1 class="inline font-semibold text-3xl mr-auto">Tags</h1>

                <filters @showing="focusSearchInput" :is-filtered="isFiltered">
                    <input type="text" class="input mt-0 w-full"
                           placeholder="Search..."
                           v-model="searchQuery"
                           ref="searchInput">
                </filters>
            </div>

            <preloader v-if="!ready"></preloader>

            <div v-if="ready && entries.length == 0 && !isFiltered">
                <p>No se encontraron etiquetas, comience por
                    <router-link :to="{name:'tag-new'}" class="no-underline text-primary hover:text-primary-dark">agregar algunas etiquetas</router-link>
                    .
                </p>
            </div>

            <div v-if="ready && entries.length == 0 && isFiltered">
               Ninguna etiqueta coincidió con la búsqueda dada.
            </div>

            <div v-if="ready && entries.length > 0">
                <div v-for="entry in entries" :key="entry.id" class="border-t border-very-light flex items-center">
                    <div class="py-4" :title="entry.title">
                        <h2 class="text-xl font-semibold">
                            <router-link :to="{name:'tag-edit', params:{id: entry.id}}" class="no-underline text-text-color">
                                {{truncate(entry.name, 80)}}
                            </router-link>
                        </h2>
                    </div>

                    <div class="ml-auto text-light mr-8">
                        {{entry.posts_count}} Post(s)
                    </div>

                    <div>{{timeAgo(entry.created_at)}}</div>
                </div>


                <tr v-if="hasMoreEntries">
                    <td colspan="100" class="text-center py-3">
                        <small><a href="#" v-on:click.prevent="loadOlderEntries" v-if="!loadingMoreEntries">Cargar etiquetas más antiguas</a></small>

                        <small v-if="loadingMoreEntries">Cargando...</small>
                    </td>
                </tr>
            </div>
        </div>
    </div>
</template>
