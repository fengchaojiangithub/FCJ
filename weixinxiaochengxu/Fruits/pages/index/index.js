//index.js
//获取应用实例
var app = getApp()
Page({
  data: {
    //motto: 'Hello World',
    //userInfo: {},
    lunbo_src: [
      '../../images/banner.png',
      '../../images/banner.png'
    ],
    lunbo_src2: [
      '../../images/img4.png',
      '../../images/img4.png'
    ],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    cate_src: [
      {
        mode: 'scaleToFill',
        text: '全部商品',
        picture: '../../images/i_1.png',
      },
      {
        mode: 'scaleToFill',
        text: '上新商品',
        picture: '../../images/i_2.png',
      },
      {
        mode: 'scaleToFill',
        text: '产品分类',
        picture: '../../images/i_3.png',
      },
      {
        mode: 'scaleToFill',
        text: '会员签到',
        picture: '../../images/i_4.png',
      },
      {
        mode: 'scaleToFill',
        text: '购买须知',
        picture: '../../images/i_5.png',
      },
      {
        mode: 'scaleToFill',
        text: '我的订单',
        picture: '../../images/i_6.png',
      },
      {
        mode: 'scaleToFill',
        text: '抽奖活动',
        picture: '../../images/i_7.png',
      },
      {
        mode: 'scaleToFill',
        text: '在线客服',
        picture: '../../images/i_8.png',
      }
    ],
    ad_src1: '../../images/img1.png',
    ad_src2: '../../images/img2.png',
    ad_src3: '../../images/img3.png',
  },
  //事件处理函数
  // bindViewTap: function() {
  //   wx.navigateTo({
  //     url: '../list/list',
  //   })
  // },
  // toast: function() {
  //   wx.navigateTo({
  //     url: '../list/list'
  //   })
  // },
   bindViewTap: function() {
    wx.navigateTo({
      url: '../personal_fx_sp/personal_fx_sp',
    })
  },
    toasts: function() {
    wx.navigateTo({
      url: '../personal_fx_sp/personal_fx_sp'
    })
  },
  onLoad: function () {
    console.log('onLoad')
    var that = this
    //调用应用实例的方法获取全局数据
    app.getUserInfo(function(userInfo){
      //更新数据
      that.setData({
        userInfo:userInfo
      })
    })
  }
})
