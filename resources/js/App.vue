<template>
  <div class="app-container">
    <header>
      <h1>Exchange Project</h1>
      <ul class="nav-list">
        <li>
          <router-link to="exchange">
            <span>Exchange Form</span>
          </router-link>
        </li>
        <li>
          <router-link to="history">
            <span>Your Exchanges</span>
          </router-link>
        </li>
      </ul>
    </header>

    <main>
        <router-view />
    </main>
  </div>
</template>

<script>
import ExchangeForm from "./components/ExchangeForm";

export default {
  components: {
    ExchangeForm,
  },
};
</script>

<style lang="scss" scoped>
.app-container {
  header {
    height: 70px;
    display: flex;
    color: white;
    padding: 0 16px;
    align-items: center;
    background-color: #2196f3;
    box-shadow: 0 3px 4px rgba($color: #000000, $alpha: 0.2);

    h1 {
      margin: 0;
      padding: 0;
      flex-shrink: 1;
      font-size: 1.8rem;
      line-height: 1.8rem;
    }

    ul {
      height: 100%;
      list-style: none;

      li {
        height: 100%;
        display: inline-block;

        a {
          height: 100%;
          font-size: 1rem;
          padding: 0 16px;
          color: #fafafa;
          align-items: center;
          display: inline-flex;
          text-decoration: none;
          transition: all 250ms;
          box-sizing: border-box;
          vertical-align: middle;
          justify-content: center;

          &:hover {
            background-color: #1e88e5;
          }

          &.router-link-active {
            border-bottom: solid 4px #ff5722;

            span {
              margin-top: 4px;
            }
          }
        }
      }
    }
  }
}
</style>
