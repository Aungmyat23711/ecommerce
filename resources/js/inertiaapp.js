import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import "./bootstrap"
createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})