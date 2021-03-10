<script type="text/ecmascript">

    export default {
        computed: {
            hideLogoOnSmallScreens() {
                return this.$slots['left-side']
            }
        }
    }
</script>

<template>
    <div class="border-b border-very-light mb-2">
        <div class="container">
            <div class="flex justify-content-end py-2">
                <div class="flex items-center">
                    <slot name="right-side"></slot>
                    <dropdown class="relative ml-6">
                        <button slot="trigger" type="button" class="focus:outline-none">
                            <img :src="Wink.author.avatar" class="rounded-full w-8 h-8" :title="Wink.author.name">
                        </button>
                        <div slot="content" class="dropdown-content pin-r min-w-dropdown mt-1 text-sm py-2">
                            <router-link to="/posts" class="no-underline text-text-color hover:text-primary w-full block py-2 px-4">
                                Posts
                            </router-link>
                            <router-link to="/tags" class="no-underline text-text-color hover:text-primary w-full block py-2 px-4">
                                Tags
                            </router-link>
                        </div>
                    </dropdown>
                </div>
            </div>
        </div>
    </div>
</template>
