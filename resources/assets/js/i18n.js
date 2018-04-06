import Vue from 'vue';
import VueI18n from 'vue-i18n';
import en from './lang/en.json';
import kh from './lang/kh.json';

Vue.use(VueI18n);
const locale = 'kh';

const messages = {
    en: en,
    kh: kh
};

const i18n = new VueI18n({
    locale,
    messages
});

export default i18n;
