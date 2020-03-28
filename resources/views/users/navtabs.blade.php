 <ul id="users-navtabs-tab">
  <li 
   v-bind:class="{active:activeTab==='enposts-tab'}"
   v-on:click="activeTab='enposts-tab'"
  >
   過去の投稿
  </li>
  <li 
   v-bind:class="{active:activeTab==='corrections-tab'}"
   v-on:click="activeTab='corrections-tab'"
  >
   添削した投稿
  </li>
</ul>

