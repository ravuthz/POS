import Vue from 'vue';
import VueI18n from 'vue-i18n';
import en from './lang/en.json';

Vue.use(VueI18n);
const locale = 'en';

const messages = {
    en: en
};

const i18n = new VueI18n({
    locale,
    messages
});

export default i18n;
