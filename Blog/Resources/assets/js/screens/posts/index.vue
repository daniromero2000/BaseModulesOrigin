<script type="text/ecmascript">
import loadsEntries from "../loadsEntries";
import FiltersDropdown from "../../partials/FilterDropdown.vue";

export default {
  mixins: [loadsEntries],

  components: {
    filters: FiltersDropdown,
  },

  /**
   * The component's data.
   */
  data() {
    return {
      baseURL: "/api/posts",
      tags: [],
      authors: [],
      entries: [],
      hasMoreEntries: false,
      nextPageUrl: null,
      loadingMoreEntries: false,
      ready: false,
      searchQuery: "",

      filters: {
        status: "",
        author_id: "",
        tag_id: "",
      },
    };
  },

  /**
   * Prepare the component.
   */
  mounted() {
    document.title = "Posts — Wink.";

    this.loadEntries();

    this.loadResources();

    this.watchFiltersChanges();
  },

  methods: {
    /**
     * Load the resources needed for the screen.
     */
    loadResources() {
      this.http()
        .get("/api/tags")
        .then((response) => {
          this.tags = response.data.data;
        });

      this.http()
        .get("/api/team")
        .then((response) => {
          this.authors = response.data.data;
        });
    },

    /**
     * Format the given tags for display.
     */
    formatTags(tags) {
      return _.chain(tags).map("name").join(", ").value();
    },

    /**
     * Clear the filters.
     */
    clearFilters() {
      this.searchQuery = "";

      Object.keys(this.filters).forEach(
        (filter) => (this.filters[filter] = "")
      );
    },
  },
};
</script>

<template>
  <div>
    <page-header>
      <template slot="right-side">
        <router-link
          :to="{ name: 'post-new' }"
          class="py-1 px-2 btn-primary text-sm text-white border-0"
        >
          Crear Post
        </router-link>
      </template>
    </page-header>

    <div class="container">
      <div class="mb-10 flex items-center"></div>

      <preloader v-if="!ready"></preloader>

      <div v-if="ready && entries.length == 0 && !isFiltered">
        No se encontraron publicaciones, comience por
        <router-link
          :to="{ name: 'post-new' }"
          class="no-underline text-primary hover:text-primary-dark"
          >escribir su primera publicación</router-link
        >
        .
      </div>

      <div v-if="ready && entries.length == 0 && isFiltered">
        Ninguna publicación coincidió con la búsqueda dada.
      </div>

      <div v-if="ready && entries.length > 0">
        <div class="card">
          <!-- Card header -->
          <div class="card-header d-flex">
            <!-- Title -->
            <h5 class="h3 mb-0">Posts</h5>
            <div class="ml-auto">
              <filters
                @showing="focusSearchInput"
                :is-filtered="isFiltered"
                class="text-sm"
              >
                <input
                  type="text"
                  class="input mt-0 w-full pb-2 border-b border-very-light"
                  placeholder="Search..."
                  v-model="searchQuery"
                  ref="searchInput"
                />

                <div class="flex items-center justify-between mt-5">
                  <span>Estado</span>
                  <select
                    name="status"
                    class="border border-lighter rounded w-3/5 focus:outline-none appearance-none py-1 px-3"
                    v-model="filters.status"
                  >
                    <option value="">Todos</option>
                    <option value="live">Live</option>
                    <option value="published">Publicada</option>
                    <option value="scheduled">Programada</option>
                    <option value="draft">Borrador</option>
                  </select>
                </div>

                <div class="flex items-center justify-between mt-3">
                  <span>Author</span>
                  <select
                    name="author"
                    class="border border-lighter rounded w-3/5 focus:outline-none appearance-none py-1 px-3"
                    v-model="filters.author_id"
                  >
                    <option value="">Todos</option>
                    <option v-for="author in authors" :value="author.id">
                      {{ author.name }}
                    </option>
                  </select>
                </div>

                <div class="flex items-center justify-between mt-3">
                  <span>Tag</span>
                  <select
                    name="tag"
                    class="border border-lighter rounded w-3/5 focus:outline-none appearance-none py-1 px-3"
                    v-model="filters.tag_id"
                  >
                    <option value="">Todos</option>
                    <option v-for="tag in tags" :value="tag.id">
                      {{ tag.name }}
                    </option>
                  </select>
                </div>

                <button
                  v-if="isFiltered"
                  @click.prevent="clearFilters"
                  class="btn-sm btn-light w-full mt-5"
                >
                  Reset
                </button>
              </filters>
            </div>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div
              v-for="entry in entries"
              :key="entry.id"
              class="border-t border-very-light flex items-center"
            >
              <!-- List group -->
              <ul class="list-group list-group-flush w-100 list my--3">
                <li class="list-group-item px-0">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <a class="avatar rounded-circle">
                        <router-link
                          :to="{ name: 'post-edit', params: { id: entry.id } }"
                          class="no-underline ml-auto hidden lg:block"
                        >
                          <div
                            class="w-16 h-16 rounded-full bg-cover"
                            v-if="entry.featured_image"
                            :style="{
                              backgroundImage:
                                'url(' + entry.featured_image + ')',
                            }"
                          ></div>
                          <div
                            class="w-16 h-16 rounded-full bg-light flex items-center justify-center text-4xl text-contrast"
                            v-else="entry.featured_image"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              class="fill-current w-8"
                            >
                              <path
                                d="M0 6c0-1.1.9-2 2-2h3l2-2h6l2 2h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6zm10 10a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"
                              />
                            </svg>
                          </div>
                        </router-link>
                      </a>
                    </div>
                    <div class="col">
                      <div class="py-4" :title="entry.title">
                        <h2 class="text-xl font-semibold mb-3">
                          <router-link
                            :to="{
                              name: 'post-edit',
                              params: { id: entry.id },
                            }"
                            class="no-underline text-text-color"
                          >
                            {{ truncate(entry.title, 68) }}
                          </router-link>
                        </h2>

                        <p class="mb-3">
                          {{
                            truncate(
                              entry.body.replace(/(<([^>]+)>)/gi, ""),
                              100
                            )
                          }}
                        </p>

                        <small class="text-light">
                          <span
                            v-if="
                              entry.published &&
                              !dateInTheFuture(entry.publish_date)
                            "
                            >Publicada {{ timeAgo(entry.publish_date) }}</span
                          >
                          <span
                            v-if="
                              entry.published &&
                              dateInTheFuture(entry.publish_date)
                            "
                            class="text-green"
                            >Programada {{ timeAgo(entry.publish_date) }}</span
                          >
                          <span v-if="!entry.published" class="text-red"
                            >Draft</span
                          >
                          — Updated {{ timeAgo(entry.updated_at) }}
                          <span v-if="entry.tags.length"
                            >— Tags: {{ formatTags(entry.tags) }}</span
                          >
                        </small>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div v-if="hasMoreEntries">
          <div colspan="100" class="py-8 uppercase">
            <a
              href="#"
              v-on:click.prevent="loadOlderEntries"
              v-if="!loadingMoreEntries"
              class="no-underline text-primary"
              >Load more posts</a
            >
            <span v-if="loadingMoreEntries">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
