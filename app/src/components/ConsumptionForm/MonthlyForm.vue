<template>
  <form>
    <div class="form-row">
      <div class="form-col">
        <b-field label="Номінація / Коригування *" required>
          <b-select
            v-model="order_type"
            placeholder="Оберіть тип заявки"
            rounded
            expanded
            icon-pack="fas"
          >
            <option value="flint">Номінація</option>
            <option value="silver">Коригування</option>
          </b-select>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Місяць*">
          <b-select
            v-model="order_month"
            placeholder="Оберіть місяць"
            rounded
            expanded
          >
            <option
              v-for="month in months"
              :key="month.code"
              value="month.code"
            >
              {{ month.label }}
            </option>
          </b-select>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Рік*">
          <b-select
            v-model="order_year"
            placeholder="Оберіть рік"
            rounded
            expanded
          >
            <option v-for="year in years" :key="year.code" value="year.code">
              {{ year.label }}
            </option>
          </b-select>
        </b-field>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
        <b-field label="Назва ОСР*">
          <b-autocomplete
            rounded
            v-model="osr_name"
            :open-on-focus="true"
            :data="osrArray"
            placeholder="Введіть і оберіть вашу ОСР"
            icon="magnify"
            icon-right="caret-down"
            @select="(option) => (selected = option)"
          >
            <template #empty>Немає результатів по запиту</template>
          </b-autocomplete>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Група *" grouped group-multiline>
          <b-radio-button
            v-model="groupType"
            native-value="group_a"
            type="is-light is-outlined"
            expanded
          >
            <span>Група А</span>
          </b-radio-button>
          <b-radio-button
            v-model="groupType"
            native-value="group_b"
            type="is-light is-outlined"
            expanded
          >
            <span>Група Б</span>
          </b-radio-button>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Обсяг *">
          <b-input v-model="amount" placeholder="ХХХ ХХХ кВт/місяць"></b-input>
        </b-field>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
        <b-field label="ЄДРПОУ / ІПН*">
          <b-input v-model="identify_code" placeholder="хххххххх"></b-input>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Код безпеки*">
          <b-input v-model="security_code" placeholder="хххххххх"></b-input>
        </b-field>
      </div>
      <div class="form-col">
        <button class="f-button" @click="onSubmit">Відправити</button>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  name: "MonthlyForm",
  data: () => ({
    order_type: null,
    order_month: null,
    order_year: null,
    groupType: null,
    identify_code: null,
    security_code: null,
    amount: null,
    osr_name: null,
    months: [
      { label: "січень", code: "01" },
      { label: "лютий", code: "02" },
      { label: "березень", code: "03" },
      { label: "квітень", code: "04" },
      { label: "травень", code: "05" },
      { label: "червень", code: "06" },
      { label: "липень", code: "07" },
      { label: "серпень", code: "08" },
      { label: "вересень", code: "09" },
      { label: "жовтень", code: "10" },
      { label: "листопад", code: "11" },
      { label: "грудень", code: "12" },
    ],
    years: [
      { label: "2022", code: "2022" },
      { label: "2023", code: "2023" },
      { label: "2024", code: "2024" },
    ],
    osrs: [
      { label: "АТ «ВІННИЦЯОБЛЕНЕРГО»", code: "АТ «ВІННИЦЯОБЛЕНЕРГО»" },
      {
        label: "АТ «ДТЕК ДНІПРОВСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
        code: "АТ «ДТЕК ДНІПРОВСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
      },
      {
        label: "АТ «ДТЕК ДОНЕЦЬКІ ЕЛЕКТРОМЕРЕЖІ»",
        code: "АТ «ДТЕК ДОНЕЦЬКІ ЕЛЕКТРОМЕРЕЖІ»",
      },
      {
        label: "АТ «ДТЕК ОДЕСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
        code: "АТ «ДТЕК ОДЕСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
      },
      { label: "АТ «МИКОЛАЇВОБЛЕНЕРГО»", code: "АТ «МИКОЛАЇВОБЛЕНЕРГО»" },
      { label: "АТ «ПРИКАРПАТТЯОБЛЕНЕРГО»", code: "АТ «ПРИКАРПАТТЯОБЛЕНЕРГО»" },
      { label: "АТ «СУМИОБЛЕНЕРГО» ", code: "АТ «СУМИОБЛЕНЕРГО» " },
      { label: "АТ «УКРЗАЛІЗНИЦЯ» ", code: "АТ «УКРЗАЛІЗНИЦЯ» " },
      { label: "АТ «ХАРКІВОБЛЕНЕРГО»", code: "АТ «ХАРКІВОБЛЕНЕРГО»" },
      { label: "АТ «ХЕРСОНОБЛЕНЕРГО»", code: "АТ «ХЕРСОНОБЛЕНЕРГО»" },
      { label: "АТ «ХМЕЛЬНИЦЬКОБЛЕНЕРГО»", code: "АТ «ХМЕЛЬНИЦЬКОБЛЕНЕРГО»" },
      { label: "АТ «ЧЕРНІВЦІОБЛЕНЕРГО»", code: "АТ «ЧЕРНІВЦІОБЛЕНЕРГО»" },
      { label: "АТ «ЧЕРНІГІВОБЛЕНЕРГО»", code: "АТ «ЧЕРНІГІВОБЛЕНЕРГО»" },
      { label: "АТ«ЖИТОМИРОБЛЕНЕРГО»", code: "АТ«ЖИТОМИРОБЛЕНЕРГО»" },
      { label: "ВАТ «ТЕРНОПІЛЬОБЛЕНЕРГО»", code: "ВАТ «ТЕРНОПІЛЬОБЛЕНЕРГО»" },
      {
        label: "ДП «РЕГІОНАЛЬНІ ЕЛЕКТРИЧНІ МЕРЕЖІ»",
        code: "ДП «РЕГІОНАЛЬНІ ЕЛЕКТРИЧНІ МЕРЕЖІ»",
      },
      { label: "ДПЕМ ПРАТ «АТОМСЕРВІС»", code: "ДПЕМ ПРАТ «АТОМСЕРВІС»" },
      { label: "ПАТ «ЗАПОРІЖЖЯОБЛЕНЕРГО»", code: "ПАТ «ЗАПОРІЖЖЯОБЛЕНЕРГО»" },
      { label: "ПАТ «НЕК «УКРЕНЕРГО»", code: "ПАТ «НЕК «УКРЕНЕРГО»" },
      { label: "ПАТ «ПОЛТАВАОБЛЕНЕРГО»", code: "ПАТ «ПОЛТАВАОБЛЕНЕРГО»" },
      { label: "ПАТ «ЧЕРКАСИОБЛЕНЕРГО»", code: "ПАТ «ЧЕРКАСИОБЛЕНЕРГО»" },
      { label: "ПРАТ «ВОЛИНЬОБЛЕНЕРГО»", code: "ПРАТ «ВОЛИНЬОБЛЕНЕРГО»" },
      {
        label: "ПРАТ «ДТЕК КИЇВСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
        code: "ПРАТ «ДТЕК КИЇВСЬКІ ЕЛЕКТРОМЕРЕЖІ»",
      },
      {
        label: "ПРАТ «ДТЕК КИЇВСЬКІ РЕГІОНАЛЬНІ ЕЛЕКТРОМЕРЕЖІ»",
        code: "ПРАТ «ДТЕК КИЇВСЬКІ РЕГІОНАЛЬНІ ЕЛЕКТРОМЕРЕЖІ»",
      },
      {
        label: "ПРАТ «ДТЕК ПЕМ-ЕНЕРГОВУГІЛЛЯ»",
        code: "ПРАТ «ДТЕК ПЕМ-ЕНЕРГОВУГІЛЛЯ»",
      },
      {
        label: "ПРАТ «ЗАКАРПАТТЯОБЛЕНЕРГО»",
        code: "ПРАТ «ЗАКАРПАТТЯОБЛЕНЕРГО»",
      },
      {
        label: "ПРАТ «КІРОВОГРАДОБЛЕНЕРГО»",
        code: "ПРАТ «КІРОВОГРАДОБЛЕНЕРГО»",
      },
      { label: "ПРАТ «ЛЬВІВОБЛЕНЕРГО»", code: "ПРАТ «ЛЬВІВОБЛЕНЕРГО»" },
      { label: "ПРАТ «ПЕЕМ «ЦЕК»", code: "ПРАТ «ПЕЕМ «ЦЕК»" },
      { label: "ПРАТ «РІВНЕОБЛЕНЕРГО»", code: "ПРАТ «РІВНЕОБЛЕНЕРГО»" },
      {
        label: "ТОВ «ДТЕК ВИСОКОВОЛЬТНІ МЕРЕЖІ»",
        code: "ТОВ «ДТЕК ВИСОКОВОЛЬТНІ МЕРЕЖІ»",
      },
      {
        label: "ТОВ «ЛУГАНСЬКЕ ЕНЕРГЕТИЧНЕ ОБ’ЄДНАННЯ»",
        code: "ТОВ «ЛУГАНСЬКЕ ЕНЕРГЕТИЧНЕ ОБ’ЄДНАННЯ»",
      },
      {
        label: "ТОВ «НАФТОГАЗ ТЕПЛО» (м. Новий Розділ)",
        code: "ТОВ «НАФТОГАЗ ТЕПЛО» (м. Новий Розділ)",
      },
      {
        label: "ТОВ «НАФТОГАЗ ТЕПЛО» (м. Новояворівськ)",
        code: "ТОВ «НАФТОГАЗ ТЕПЛО» (м. Новояворівськ)",
      },
    ],
  }),
  created() {
    // TODO: generate years
    // this.years = [];
  },
  computed: {
    osrArray() {
      return this.osrs.map((item) => item.label);
    },
  },
  methods: {
    onSubmit() {
      console.log("Submit");
    },
  },
};
</script>
<style lang="scss" scoped></style>
