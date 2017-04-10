<template>
    <div class="image__preview" v-if="image">
        <img :src="image">
        <button class="btn btn__danger image__close" @click="$emit('close')">
            &times;
        </button>
    </div>
</template>

<script type="text/babel">
    export default {
        props: {
          preview: {
              type: [String, File],
              default: null
          }
        },
        data(){
            return {
                image: null
            }
        },
        created() {
            this.setPreview()
        },
        watch: {
            'preview':'setPreview'
        },
        methods: {
            setPreview() {
                if(this.preview instanceof File) {
                    const fileReader = new FileReader()
                    fileReader.onload = (event) => {
                        this.image = event.target.result
                    }
                    fileReader.readAsDataURL(this.preview)
                }else if(typeof this.preview === 'string'){
                    this.image = `/images/${this.preview}`
                } else {
                    this.image = null
                }
            }
        }
    }
</script>