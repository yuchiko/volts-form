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
    <RepeatedMonthInputs
      v-for="(obj, index) in repeatData"
      :key="index"
      :input-data="repeatData[index]"
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
    order_month: null,
    order_year: null,
    identify_code: null,
    security_code: null,
    organizationType: "legal_person",
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
    // TODO: generate years
    // this.years = [];
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
  },
};
</script>
