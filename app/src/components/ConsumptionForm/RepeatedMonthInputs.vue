<template>
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
            :clearable="false"
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
</template>
<script>
export default {
  name: "RepeatedMonthInputs",
  data: () => ({
    selectedOsr: "",
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
    groupType: null,
    voltageType: null,
    amount: {
      value: null,
      rawValue: null,
    },
  }),
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
  }
};
</script>
<style lang="scss"></style>
