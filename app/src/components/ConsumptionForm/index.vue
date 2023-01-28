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

.f-input-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.f-input {
  border: 1.5px solid #7F8180;
  background: none;
  padding: 10px 18px;
  border-radius: 25px;
  width: 100%;
  color: white;

  &:active, &:focus {
    border-color: white;
    background: none;
  }
}

.f-label {
  color: #FFD701;
  display: block;
  font-size: 14px;
  margin-bottom: 8px;
}

.f-button {
  padding: 12px 50px;
  font-size: 16px;
  background: #FFD701;
  color: #151516;
  border-radius: 25px;
  margin: 0;
  border: 0;
}

.f-select {
  flex: 0 0 100%;
  width: 100%;
}

.f-select .vs__dropdown-toggle {
  background: none;
  padding: 8px 18px;
  border-radius: 25px;
  border: 1.5px solid #7F8180;
}

.f-select .vs__search::placeholder {
  color: #7F8180;
}

.f-select .vs__actions {
  padding-right: 14px;
}

.f-select .vs__selected {
  color: white;
}

.f-select .vs__dropdown-menu {
  background: #151516;
  border: none;
  color: white;
  text-transform: lowercase;
  font-variant: small-caps;
}

.f-select .vs__clear,
.f-select .vs__open-indicator {
  fill: white;
}
</style>
