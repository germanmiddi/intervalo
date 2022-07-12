<template>
  <App>
    <div
      class="hero"
      style="
        background-image: url('img/banner-aprendizaje-por-competencias.jpeg');
      "
    >
      <div class="hero-overlay bg-opacity-60"></div>
      <div class="hero-content text-center text-neutral-content">
        <div class="w-4/5 py-20 flex flex-col items-center justify-center">
          <h1 class="mb-5 text-4xl lg:text-5xl font-bold">
            Diagnostico de Competencias
          </h1>
          <p class="mb-5">
            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
            excepturi exercitationem quasi. In deleniti eaque aut repudiandae et
            a id nisi.
          </p>
          <div class="form-control">
            <div class="input-group">
              <input
                type="text"
                placeholder="Buscar..."
                class="input input-bordered"
              />
              <button class="btn btn-primary">
                <Icons name="search" class="h-6 w-6" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="flex justify-end">
        <div
          v-show="start"
          class="grid-span-1 md:col-span-2 xl:col-span-3 flex justify-end"
        >
          <a
            :href="route('quiz', { competencias: this.compselected })"
            class="btn btn-primary space-x-2"
          >
            <span>Comenzar</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 5l7 7-7 7"
              />
            </svg>
          </a>
        </div>
      </div>

      <div class="flex flex-wrap justify-around">
        <competencia-item
          @toggleText="toggleText"
          v-for="(c, idx) in competencies"
          class="transition w-[30%] mt-10"
          :class="c.visible ? '!w-[100%]' : null"
          :key="c.id"
          :item="c"
          :index="idx"
          @click="selectCompetencia(c.id)"
        />
      </div>
    </div>
  </App>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import App from "@/Layouts/Web/App.vue";
import Icons from "@/Layouts/Components/Icons.vue";
import CompetenciaItem from "@/Layouts/Web/CompetenciaItem.vue";

export default {
  props: {
    competencias: Object,
  },
  components: {
    Head,
    App,
    Icons,
    CompetenciaItem,
  },
  data() {
    return {
      competencies: null,
      start: true,
      compselected: [],
    };
  },
  methods: {
    toggleText(val) {
      this.competencies[val].visible = !this.competencies[val].visible;
    },
  },
  created() {
    this.competencies = this.competencias;
    this.competencies = this.competencies.map((el) => {
      el.visible = false;
      return el;
    });
  },
  methods: {
    selectCompetencia(id) {
      console.log(id);
      if (!this.compselected.includes(id)) {
        this.compselected.push(id);
        console.log(this.compselected);
      } else {
        this.compselected.splice(this.compselected.indexOf(id), 1);
        console.log(this.compselected);
      }
    },
  },
};
</script>

<style scoped>
.transition {
  /* width: 30%; */
  transition: width 0.7s;
}
.transition-end {
  /* width: 100%; */
}
</style>