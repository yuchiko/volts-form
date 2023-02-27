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
            v-model="orderMonth"
            placeholder="Оберіть місяць"
            rounded
            expanded
            @input="onMonthSelectChange"
          >
            <option
              v-for="month in months"
              :key="month.code"
              :value="month.code"
              :disabled="isDisabledMonth(month.code)"
            >
              {{ month.label }}
            </option>
          </b-select>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Рік">
          <b-select
            v-model="orderYear"
            placeholder="Оберіть рік"
            rounded
            expanded
            @input="onYearSelectChange"
          >
            <option v-for="year in years" :key="year.code" :value="year.code">
              {{ year.label }}
            </option>
          </b-select>
        </b-field>
      </div>
    </div>
    <RepeatedMonthInputs
      v-for="(obj, index) in repeatData"
      :key="index"
      :input-data="repeatData[index]"
      :is-last="repeatData.length - 1 === index"
      :active="activeRow === index"
      :num="index+1"
      @expand="() => {onExpand(index)}"
      @save="onSave"
      @add-row="() => { onAddRowHandler(index)}"
    />
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
        <b-field
          :label="organizationType === 'legal_person' ? 'ЄДРПОУ' : 'ІПН'"
        >
          <b-input
            v-model="identify_code"
            placeholder="x_x_x_x_x_x_x_x"
          ></b-input>
        </b-field>
      </div>
      <div class="form-col">
        <b-field label="Код безпеки">
          <b-input v-model="security_code" placeholder="хххххххх"></b-input>
        </b-field>
      </div>
    </div>
    <div class="form-row mt-5">
      <div class="form-col form-col--full text-left">
        <b-field align="left">
          <b-checkbox>
            Натискаючи "Відправити" ви погоджуєтеся на обробку ваших
            персональних даних</b-checkbox
          >
        </b-field>
        <button class="f-button" @click="onSubmit">Відправити</button>
      </div>
    </div>
  </form>
</template>
<script>
import Vue from 'vue';
import Cleave from "cleave.js";
import RepeatedMonthInputs from "./RepeatedMonthInputs";

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
  components: {
    RepeatedMonthInputs,
  },
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
    orderMonth: null,
    orderYear: null,
    identify_code: null,
    security_code: null,
    activeRow: 0,
    organizationType: "legal_person",
    months: [
      { label: "Січень", code: 1 },
      { label: "Лютий", code: 2 },
      { label: "Березень", code: 3 },
      { label: "Квітень", code: 4 },
      { label: "Травень", code: 5 },
      { label: "Червень", code: 6 },
      { label: "Липень", code: 7 },
      { label: "Серпень", code: 8 },
      { label: "Вересень", code: 9 },
      { label: "Жовтень", code: 10 },
      { label: "Листопад", code: 11 },
      { label: "Грудень", code: 12 },
    ],
    years: [
      { label: "2022", code: 2022 },
      { label: "2023", code: 2023 },
      { label: "2024", code: 2024 },
    ],
    repeatDataTemplate: {
      selectedOsr: "",
      groupType: null,
      voltageType: null,
      amount: {
        value: null,
        rawValue: null,
      },
    },
    repeatData: [
      {
        selectedOsr: "",
        groupType: null,
        voltageType: null,
        amount: {
          value: null,
          rawValue: null,
        },
      },
    ],
  }),
  created() {
    this.generateYears();
    this.autoPickDateInputs();
  },
  methods: {
    onSubmit() {
      console.log("Submit");
    },
    onInput(event) {
      const name = event.target.name;
      this[name].rawValue = event.target._vCleave.getRawValue();
      this[name].value = event.target._vCleave.getFormattedValue();
    },
    validData(data){
      console.log('data', data);
    },
    onAddRowHandler(i) {
      if (true || this.validData(this.repeatData[i])) {
        const rowClone = JSON.parse(JSON.stringify(this.repeatDataTemplate))
        Vue.set(this.repeatData, i+1, rowClone)
        this.activeRow = i+1
      }
    },
    onMonthSelectChange() {
      // console.log(this.orderMonth);
    },
    onYearSelectChange() {
      this.orderMonth = null;
    },
    generateYears() {
      const currentTime = new Date();
      this.years = [{
        label: currentTime.getFullYear(),
        code: currentTime.getFullYear()
      }];
      
      if (currentTime.getMonth() + 1 >= 6) {
        this.years.push({
        label: currentTime.getFullYear() + 1,
        code: currentTime.getFullYear() + 1
      })
      }
    },
    autoPickDateInputs() {
      const currentTime = new Date();
      this.orderMonth = this.months.filter(
        (item) => item.code === currentTime.getMonth() + 1
      )[0].code;
      this.orderYear = this.years.filter(
        (item) => item.code === currentTime.getFullYear()
      )[0].code;
    },
    isDisabledMonth(monthCode) {
      const currentTime = new Date();
      if (!this.orderYear) return false;
      if (this.orderYear === currentTime.getFullYear() && monthCode < currentTime.getMonth() + 1) return true;
    },
    onExpand(i) {
      this.activeRow = i;
    },
    onSave() {
      // Save
    }
  },
};
</script>
