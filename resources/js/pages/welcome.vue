<template>
  <el-row
    type="flex"
    justify="center"
    :gutter="20"
  >
    <el-col :span="5">
      <el-menu :default-openeds="['1']">
        <el-submenu index="1">
          <template slot="title">
            <i class="el-icon-search" /> Filters
          </template>

          <el-menu-item index="1-1">
            <el-tooltip class="item" effect="dark" content="Price" placement="top">
              <el-slider
                v-model="filters.price"
                label="Price"
                range
                :min="100000"
                :max="1000000"
                @change="getHouses"
              />
            </el-tooltip>
          </el-menu-item>

          <el-menu-item index="1-2">
            <el-tooltip class="item" effect="dark" content="Search by name" placement="top">
              <el-input
                v-model="filters.name"
                placeholder="Search by name"
                @input="getHouses"
              />
            </el-tooltip>
          </el-menu-item>

          <el-menu-item index="1-3">
            <el-tooltip class="item" effect="dark" content="Bedrooms" placement="top">
              <el-select
                v-model="filters.bedrooms"
                placeholder="Bedrooms"
                @change="getHouses"
              >
                <el-option
                  v-for="(item, i) in options"
                  :key="i"
                  :label="item.label"
                  :value="item.value"
                />
              </el-select>
            </el-tooltip>
          </el-menu-item>

          <el-menu-item index="1-4">
            <el-tooltip class="item" effect="dark" content="Bathrooms" placement="top">
              <el-select
                v-model="filters.bathrooms"
                placeholder="Bathrooms"
                @change="getHouses"
              >
                <el-option
                  v-for="(item, i) in options"
                  :key="i"
                  :label="item.label"
                  :value="item.value"
                />
              </el-select>
            </el-tooltip>
          </el-menu-item>

          <el-menu-item index="1-5">
            <el-tooltip class="item" effect="dark" content="Storeys" placement="top">
              <el-select
                v-model="filters.storeys"
                placeholder="Storeys"
                @change="getHouses"
              >
                <el-option
                  v-for="(item, i) in options"
                  :key="i"
                  :label="item.label"
                  :value="item.value"
                />
              </el-select>
            </el-tooltip>
          </el-menu-item>

          <el-menu-item index="1-6">
            <el-tooltip class="item" effect="dark" content="Garages" placement="top">
              <el-select
                v-model="filters.garages"
                placeholder="Garages"
                @change="getHouses"
              >
                <el-option
                  v-for="(item, i) in options"
                  :key="i"
                  :label="item.label"
                  :value="item.value"
                />
              </el-select>
            </el-tooltip>
          </el-menu-item>
        </el-submenu>
      </el-menu>
    </el-col>

    <el-col :span="16">
      <template v-if="houses">
        <el-row>
          <el-col :span="24">
            <el-table
              v-loading="loading"
              :data="houses.data"
              empty-text="No data"
            >
              <el-table-column prop="name" label="Name" />
              <el-table-column prop="bathrooms" label="Bathrooms" width="120" />
              <el-table-column prop="bedrooms" label="Bedrooms" width="120" />
              <el-table-column prop="garages" label="Garages" width="120" />
              <el-table-column prop="storeys" label="Storeys" width="120" />
              <el-table-column prop="price" label="Price" width="120" />
            </el-table>
          </el-col>
        </el-row>

        <el-row :gutter="20">
          <el-col :span="12" :offset="6">
            <el-pagination
              background
              layout="prev, pager, next"
              :total="houses.total"
              @current-change="getPage"
            />
          </el-col>
        </el-row>
      </template>
    </el-col>
  </el-row>
</template>

<script>
import axios from 'axios'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('houses') }
  },

  data: () => ({
    title: window.config.appName,
    loading: false,
    currentPage: 1,
    houses: null,
    filters: {
      name: null,
      price: [100000, 1000000],
      bedrooms: null,
      bathrooms: null,
      storeys: null,
      garages: null
    },
    options: [
      {
        value: null,
        label: 'All'
      },
      {
        value: '1',
        label: '1'
      },
      {
        value: '2',
        label: '2'
      },
      {
        value: '3',
        label: '3'
      },
      {
        value: '4',
        label: '4'
      },
      {
        value: '5',
        label: '5'
      }
    ]
  }),

  computed: {
    query () {
      return '?page=' + this.currentPage +
        '&name=' + this.filters.name +
        '&price=' + this.filters.price[0] + '-' + this.filters.price[1] +
        '&bedrooms=' + this.filters.bedrooms +
        '&bathrooms=' + this.filters.bathrooms +
        '&storeys=' + this.filters.storeys +
        '&garages=' + this.filters.garages
    }
  },

  created () {
    this.getHouses()
  },

  beforeDestroy () {
    this.houses = null
  },

  methods: {
    async getHouses () {
      this.loading = true

      await axios.get('/api/v1/houses' + this.query)
        .then(response => {
          this.houses = response.data
        })
        .catch(error => {
          console.log(error.response.data)
        })
        .finally(() => {
          this.loading = false
        })
    },
    getPage (page) {
      this.currentPage = page
      this.getHouses()
    }
  }
}
</script>
