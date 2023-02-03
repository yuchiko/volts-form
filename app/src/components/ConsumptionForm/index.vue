<template>
  <div>
    <h2 class="cf__heading">
      Форма на планові обсяги споживання електричної енергії
    </h2>
    <div class="cf__tabs">
      <div class="cf__tab-headers">
        <div class="cf__tab-header">
          <span>Денна</span>
          <FormDailyIcon />
        </div>
        <div class="cf__tab-header is-active">
          <span>Місячна</span>
          <FormMonthlyIcon />
        </div>
      </div>
      <div class="cf__tab-body">
        <MonthlyForm />
      </div>
    </div>
  </div>
</template>
<script>
import FormDailyIcon from "@/assets/form_daily.svg?inline";
import FormMonthlyIcon from "@/assets/form_monthly.svg";
import MonthlyForm from "./MonthlyForm";

export default {
  name: "ConsumptionForm",
  components: {
    FormDailyIcon,
    FormMonthlyIcon,
    MonthlyForm,
  },
};
</script>
<style lang="scss" scoped>
.cf {
  &__heading {
    font-size: 25px;
    font-weight: 700;
    color: #f8f9fa;
    text-align: center;
  }

  &__tab-headers {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  &__tab-header {
    display: flex;
    // background: color.scale(#fefefe, $alpha: -90%);
    padding: 20px 40px 15px 20px;
    border-radius: 20px 20px 0 0;
    width: 220px;
    justify-content: space-between;

    &:not(:last-child) {
      margin-right: 6px;
    }

    &.is-active {
      background: #fefefe;

      span {
        color: #151516;
      }
    }

    span {
      font-size: 18px;
      font-weight: 500;
      color: #fefefe;
    }
  }

  &__tab-body {
    position: relative;
    background: none;
    max-width: 1000px;
    margin: 0 auto;
    padding: 50px 60px;
    border: 1px solid #ffffff;
    border-radius: 30px;
  }
}
</style>

<style lang="scss">
// Buefy overrides

.select select {
  background: #020202 !important;
}

.select:not(.is-empty) select {
  color: white !important;
}

.select:not(.is-multiple):not(.is-loading)::after {
  border-color: white !important;
}

.select:not(.is-multiple):not(.is-loading)::after {
  font-family: "Font Awesome 5 Free";
  content: "\f0d7"!important;
  font-weight: 900;
  color: white;
  border: none!important;
  transform: translateY(-50%)!important;
  margin-top: 0!important;
  height: auto!important;
}

.form-col .label {
  color: #ffd701;
  display: block;
  font-size: 14px;
  margin-bottom: 8px;
  text-align: left;
}

.form-col .input {
  border: 1.5px solid #7f8180;
  background: none;
  padding: 12px 28px 12px 18px !important;
  border-radius: 25px;
  width: 100%;
  color: white;
  height: auto;

  &:active,
  &:focus {
    border-color: white;
    background: none;
  }
}

.form-col .input::placeholder {
  color: #7f8180;
}

.autocomplete .dropdown-item {
  white-space: unset !important;
  text-align: left !important;
  font-size: 12px;
}

.autocomplete .dropdown-content {
  padding-top: 0;
  padding-bottom: 0;
}

.b-radio.button {
  background: #050505;
  border: 1.5px solid #7f8180;
  color: #7f8180;
  transition: all 0.3s;
}

.b-radio.button.is-selected {
  background-color: #ffd701!important;
  color: #151516!important;
  border-color: #ffd701!important;
}

.b-radio.button.is-selected.is-focused {
  border-color: white!important;
}

// END OF Buefy overrides


.form-row {
  display: flex;
  align-items: flex-end;
  margin: 0 -15px;
  padding: 40px 0;
}

.form-col {
  flex: 0 0 33.3333%;
  max-width: 33.3333%;
  padding: 0 15px;
}


.f-button {
  padding: 12px 50px;
  font-size: 16px;
  background: #ffd701;
  color: #151516;
  border-radius: 25px;
  margin: 0;
  border: 0;
}


</style>
