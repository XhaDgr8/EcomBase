<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            Product >> Create
        </template>

        <div class="flex-between">
            <h1 class="text-white">Product Name</h1>
            <Link :href="route('Product.create')" class="btn btn-primary">
                Save
            </Link>
        </div>

        <div id="createProduct">

            <div id="img-box">

                <div class="bg-img-center"
                     :style="{ 'background-image': 'url(' + form.imgPrimary['preview'] + ')' }">
                    <label for="primary-img">
                        <div>
                            <img :src="$page.props.asset + '/icons/fileUpload.svg'" class="mx-auto" style="height: 5rem;width: 5rem" alt="">
                            <h1 class="text-gray-600 font-bold">Upload Image</h1>
                            <h1 class="truncate">{{form.imgPrimary['alt']}}</h1>
                        </div>
                    </label>
                    <input type="file" @change="PrimaryImg" id="primary-img" class="hidden">
                    <div class="absolute w-full bottom-0 px-4 pb-8">
                        <input type="text" id="img-primary" class="input w-full truncate"
                               v-model="form.imgPrimary['alt']"
                               :placeholder="form.imgPrimary['alt']">
                    </div>
                </div>

                <div id="scrollbox" class="scroll-shadow-top">
                    <div id="more-img-grid">

                        <div class="bg-img-center w-full" v-for="(item, index) in form.files"
                             :style="{ 'background-image': 'url(' + item['preview'] + ')' }">
                            <div class="absolute w-full bottom-0 pb-3">
                                <input type="text" class="input p-1" style="width: 94%"
                                       v-model="form.files[index]['alt']"
                                       :placeholder="item['name']">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-span-12">
                    <h3 class="text-red-500">{{imgErr}}</h3>
                    <label for="more-images" class="btn btn-primary mx-auto">
                        Upload More Images
                    </label>
                    <input type="file" @change="moreImages" id="more-images" class="hidden" multiple>
                </div>

            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-4">

                <h1>General Section</h1>

                <Input id="name" class="mt-5" type="text">
                    Name
                </Input>

<!--                <div class="form-group mt-5">-->
<!--                    <input type="text" id="Name">-->
<!--                    <label for="Name">Name</label>-->
<!--                </div>-->

                <div class="form-group mt-5">
                    <input type="text" id="SKU">
                    <label for="SKU">SKU</label>
                </div>

                <div class="form-group mt-5">
                    <input type="text" id="Stock">
                    <label for="Stock">Stock</label>
                </div>

            </div>

            <div class="col-span-12 md:col-span-4 lg:col-span-2">
                <div class="rounded-md bg-glass p-8">
                    <h1>Product Status</h1>
                    <p>Set the Products Visibility to True or False</p>
                </div>
                <div class="rounded-md bg-glass p-8 mt-3">
                    <h1>Preview Product</h1>
                    <p>See How the Product Looks Like To Your Customer</p>
                </div>
            </div>

<!--            <div class="col-span-12 md:col-span-5">-->
<!--                <div class="rounded-md bg-glass p-8">-->
<!--                    <h1>Product Status</h1>-->
<!--                    <p>Set the Products Visibility to True or False</p>-->
<!--                </div>-->
<!--                <div class="rounded-md bg-glass p-8 mt-3">-->
<!--                    <h1>Preview Product</h1>-->
<!--                    <p>See How the Product Looks Like To Your Customer</p>-->
<!--                </div>-->
<!--            </div>-->

        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Input from '@Components/Input';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head, Link, Input,
    },
    data() {
        return {
            imgErr: null,
            form: this.$inertia.form({
                files: new Array(),
                imgPrimary: {
                    alt: 'Alt Text',
                    file: [],
                    preview: 'https://via.placeholder.com/150',
                },
            }),
        }
    },
    methods: {
        processForm() {
            this.form.post(route('routeName'))
        },
        PrimaryImg (event){
            this.form.imgPrimary['file'] = event.target.files[0];
            this.form.imgPrimary['preview'] = URL.createObjectURL(event.target.files[0]);
            this.form.imgPrimary['alt'] = event.target.files[0].name;
        },
        moreImages(event) {
            var eventFile = event.target.files;
            for (let i = 0; i < eventFile.length; i++) {
                let arr = new Array();
                arr['file'] = eventFile[i];
                arr['preview'] = URL.createObjectURL(eventFile[i]);
                arr['alt'] = eventFile[i].name;
                this.form.files.push(arr);
            }
        },
    },
}
</script>
