<template>
  <div v-if="active" class="repeated-row">
    <div class="row-number">{{ num }}</div>
    <div class="form-row">
      <div class="form-col form-col--full">
        <b-field label="Назва ОСР">
          <b-autocomplete
            rounded
            v-model="inputData.selectedOsr"
            :open-on-focus="true"
            :data="filteredOsr"
            placeholder="Введіть і оберіть вашу ОСР"
            icon-pack="fas"
            icon-right="caret-down"
            :clearable="false"
            @select="(option) => (selected = option)"
            @blur="onBlur"
          >
            <template #footer>
              <a v-if="inputData.selectedOsr.length" @click="cleanOsrInput"
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
            v-model="inputData.voltageType"
            native-value="class_1"
            type="is-light is-outlined"
            expanded
          >
            <span>1 клас</span>
          </b-radio-button>
          <b-radio-button
            v-model="inputData.voltageType"
            native-value="class_2"
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
            v-model="inputData.groupType"
            native-value="group_a"
            type="is-light is-outlined"
            expanded
          >
            <span>Група А</span>
          </b-radio-button>
          <b-radio-button
            v-model="inputData.groupType"
            native-value="group_b"
            type="is-light is-outlined"
            expanded
          >
            <span>Група Б</span>
          </b-radio-button>
        </b-field>
      </div>
      <div
        class="form-col input-with-prefix"
        :class="{
          'is-filled': !!inputData.amount.value,
        }"
      >
        <b-field label="Обсяг">
          <b-input
            name="amount"
            v-model="inputData.amount.value"
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
    <b-button v-if="isLast" class="add-button" rounded icon-pack="fas" icon-right="plus" @click="$emit('add-row')"/>
  </div>
  <div v-else class="repeated-row repeated-row--expanded">
    <div class="row-number">{{ num }}</div>
    <div class="short-information">
      <div class="full"><span>ОСР:</span> {{ inputData.selectedOsr }}</div>
      <div><span>Напруга:</span> {{ inputData.voltageType === 'class_1' ? 'Класс 1' : 'Класс 2' }} </div>
      <div><span>Напруга:</span> {{ inputData.groupType === 'group_a' ? 'Група А' : 'Група Б' }} </div>
      <div><span>Обсяг:</span> {{ inputData.amount.value }} кВт/місяць</div>
    </div>
  </div>
</template>
<script>
export default {
  name: "RepeatedMonthInputs",
  props: {
    inputData: [Object],
    isLast: [Boolean],
    active: [Boolean],
    num: [Number]
  },
  data: () => ({
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
            .indexOf(this.inputData.selectedOsr.toLowerCase()) >= 0
        );
      });
    },
  },
  methods: {
    cleanOsrInput() {
      this.inputData.selectedOsr = "";
    },
    onBlur() {
        if (this.filteredOsr.length === 0) this.inputData.selectedOsr = '';
        if (this.filteredOsr.length === 1) this.inputData.selectedOsr = this.filteredOsr[0]
        if (this.filteredOsr.length > 1) this.inputData.selectedOsr = '';
    }
  },
};
</script>

<style scoped>
.repeated-row {
  position: relative;
  margin-bottom: 10px;
}

.add-button {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translate(-50%, 50%);
}

.short-information {
  display: flex;
  flex-wrap: wrap;
  padding: 0 60px;
  color: #7F8180;
  align-items: flex-start;
  justify-content: flex-start;
}

.short-information > div.full {
  flex: 0 0 100%;
  text-align: left;
  padding-bottom: 10px;
}

.short-information > div:not(.full) {
  text-align: left;
}

.short-information > div:not(.full):not(:last-child) {
  padding-right: 10px;
  border-right: 2px solid;
  margin-right: 10px;
}

.row-number {
  background: #ffd701;
  position: absolute;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  font-weight: 600;
  line-height: 1;
  top: 20px;
  left: 10px;
}
</style>