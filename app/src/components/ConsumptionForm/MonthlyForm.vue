<template>
  <form>
    <div class="form-row">
      <div class="form-col">
        <b-field label="Номінація / Коригування" required>
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
        <b-field label="Місяць">
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
        <b-field label="Рік">
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
    <div class="filled-row">
      <div class="form-row">
        <div>1</div>
        <div>
          <p>Назва ОСР: АТ «ВІННИЦЯОБЛЕНЕРГО»<br> Напруга: 2 класс / Група Б - ОБСЯГ: 123 кВт/місяць</p>
          <a href="#">Змінити</a>
        </div>
      </div>
    </div>
    <div class="repeated-row">
      <div class="form-row">
        <div class="form-col form-col--full">
          <b-field label="Назва ОСР">
            <b-autocomplete
              rounded
              v-model="selectedOsr"
              :open-on-focus="true"
              :data="filteredOsr"
              placeholder="Введіть і оберіть вашу ОСР"
              icon-pack="fas"
              icon-right="caret-down"
              clearable
              @select="(option) => (selected = option)"
            >
              <template #footer>
                <a v-if="selectedOsr.length" @click="cleanOsrInput"
                  ><span>Очистити поле вводу</span></a
                >
              </template>
              <template #empty>Немає результатів по запиту</template>
            </b-autocomplete>
          </b-field>
        </div>
      </div>
      <div class="form-row">
        <div class="form-col">
          <b-field
            class="one-radio-group"
            label="Напруга"
            grouped
            group-multiline
          >
            <b-radio-button
              v-model="voltageType"
              native-value="group_a"
              type="is-light is-outlined"
              expanded
            >
              <span>1 клас</span>
            </b-radio-button>
            <b-radio-button
              v-model="voltageType"
              native-value="group_b"
              type="is-light is-outlined"
              expanded
            >
              <span>2 клас</span>
            </b-radio-button>
          </b-field>
        </div>
        <div class="form-col">
          <b-field class="one-radio-group" label="Група" grouped group-multiline>
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
        <div class="form-col input-with-prefix">
          <b-field label="Обсяг">
            <b-input
              name="amount"
              v-model="amount.value"
              placeholder="ХХХ ХХХ"
            ></b-input>
            <p class="control">
              <span class="button is-static input-prefix input-prefix--after"
                >кВт/місяць</span
              >
            </p>
          </b-field>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
          <b-field
            class="one-radio-group"
            label="Тип організації"
            grouped
            group-multiline
          >
            <b-radio-button
              v-model="organizationType"
              native-value="legal_person"
              type="is-light is-outlined"
              expanded
            >
              <span>Юр. особа</span>
            </b-radio-button>
            <b-radio-button
              v-model="organizationType"
              native-value="physic_person"
              type="is-light is-outlined"
              expanded
            >
              <span>ФОП</span>
            </b-radio-button>
          </b-field>
        </div>
      <div class="form-col">
        <b-field :label="organizationType === 'legal_person' ? 'ЄДРПОУ' : 'ІПН'">
          <b-input v-model="identify_code" placeholder="x_x_x_x_x_x_x_x"></b-input>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Код безпеки">
          <b-input v-model="security_code" placeholder="хххххххх"></b-input>
        </b-field>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
        <b-checkbox />
        <button class="f-button" @click="onSubmit">Відправити</button>
      </div>
    </div>
  </form>
</template>
<script>
import Cleave from "cleave.js";

/**
 * We add a new instance of Cleave when the element
 * is bound and destroy it when it's unbound.
 */
const cleave = {
  name: "cleave",
  bind(el, binding) {
    const input = el.querySelector("input");
    input._vCleave = new Cleave(input, binding.value);
  },
  unbind(el) {
    const input = el.querySelector("input");
    input._vCleave.destroy();
  },
};

export default {
  name: "MonthlyForm",
  directives: { cleave },
  data: () => ({
    masks: {
      numeral: {
        numeral: true,
        numeralThousandsGroupStyle: "none",
        prefix: " кВт/місяць",
        tailPrefix: true,
        noImmediatePrefix: true,
        // prefix: "$ ",
      },
    },
    order_type: null,
    order_month: null,
    order_year: null,
    groupType: null,
    identify_code: null,
    security_code: null,
    organizationType: 'legal_person',
    amount: {
      value: null,
      rawValue: null,
    },
    selectedOsr: "",
    voltageType: null,
    months: [
      { label: "Січень", code: "01" },
      { label: "Лютий", code: "02" },
      { label: "Березень", code: "03" },
      { label: "Квітень", code: "04" },
      { label: "Травень", code: "05" },
      { label: "Червень", code: "06" },
      { label: "Липень", code: "07" },
      { label: "Серпень", code: "08" },
      { label: "Вересень", code: "09" },
      { label: "Жовтень", code: "10" },
      { label: "Листопад", code: "11" },
      { label: "Грудень", code: "12" },
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
    filteredOsr() {
      return this.osrArray.filter((item) => {
        return (
          item
            .toString()
            .toLowerCase()
            .indexOf(this.selectedOsr.toLowerCase()) >= 0
        );
      });
    },
  },
  methods: {
    cleanOsrInput() {
      this.selectedOsr = "";
    },
    onSubmit() {
      console.log("Submit");
    },
    onInput(event) {
      const name = event.target.name;
      this[name].rawValue = event.target._vCleave.getRawValue();
      this[name].value = event.target._vCleave.getFormattedValue();
    },
  },
};
</script>
<style lang="scss" scoped></style>
