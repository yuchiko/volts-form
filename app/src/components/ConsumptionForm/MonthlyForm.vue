<template>
  <form>
    <div class="form-row">
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label">Номінація / Коригування*</label>
          <v-select
            class="f-select"
            placeholder="Оберіть тип заявки"
            :options="['Номінація', 'Коригування']"
          />
        </div>
      </div>
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label">Місяць*</label>
          <v-select
            class="f-select"
            placeholder="Оберіть місяць"
            :options="['Січень', 'Липень']"
          />
        </div>
      </div>
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label">Рік*</label>
          <v-select
            class="f-select"
            placeholder="Оберіть рік"
            :options="['2022', '2023']"
          />
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label">Назва ОСР*</label>
          <v-select
            class="f-select"
            placeholder="Оберіть вашу ОСР"
            :options="['АТ «ВІННИЦЯОБЛЕНЕРГ', 'АТ «ДТЕК ДНІПРОВСЬКІ ЕЛЕКТРОМЕРЕЖІ»']"
          />
        </div>
      </div>
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label">Група*</label>
          <v-select
            class="f-select"
            placeholder="Оберіть вашу групу"
            :options="['Група А', 'Група Б']"
          />
        </div>
      </div>
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label" for="f-month-amount">Обсяг*</label>
          <input
            id="f-month-amount"
            class="f-input"
            placeholder="ХХХ ХХХ кВт/місяць"
            type="text"
          />
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label" for="f-month-amount">ЄДРПОУ / ІПН*</label>
          <input
            id="f-month-amount"
            class="f-input"
            placeholder="хххххххх"
            type="text"
          />
        </div>
      </div>
      <div class="form-col">
        <div class="f-input-group">
          <label class="f-label" for="f-month-amount">Код безпеки*</label>
          <input
            id="f-month-amount"
            class="f-input"
            placeholder="ххххх"
            type="text"
          />
        </div>
      </div>
      <div class="form-col">
        <button class="f-button">Відправити</button>
      </div>
    </div>
  </form>
</template>
<script>
import vSelect from "vue-select";

export default {
  name: "MonthlyForm",
  components: {
    vSelect,
  },
};
</script>
<style lang="scss" scoped></style>
