# 爬取微信公众号
import csv
import os
import re

import requests
from selenium import webdriver
import time
import json
def function():
    '''第一步：登录微信公众号，获取cookies'''
    # 调用谷歌浏览器驱动
    driver = webdriver.Chrome()
    # driver = webdriver.Firefox() # 调用火狐浏览器驱动
    driver.get("https://mp.weixin.qq.com/")  # 微信公众平台网址
    driver.find_element_by_link_text("使用帐号登录").click()  # 此行代码为2020.10.10新增，因为微信公众号页码原来默认直接为登录框， 现在默认为二维码，此行代码可以将二维码切换到登录框页面
    driver.find_element_by_name("account").clear()
    driver.find_element_by_name("account").send_keys("1079931150@qq.com")  # 自己的微信公众号
    time.sleep(2)
    driver.find_element_by_name("password").clear()
    driver.find_element_by_name("password").send_keys("kxh20000214")  # 自己的微信公众号密码
    driver.find_element_by_class_name("icon_checkbox").click()

    time.sleep(2)
    driver.find_element_by_class_name("btn_login").click()
    time.sleep(15)
    # 此时会弹出扫码页面，需要微信扫码
    cookies = driver.get_cookies()  # 获取登录后的cookies
    print(cookies)
    cookie = {}
    for items in cookies:
        cookie[items.get("name")] = items.get("value")
    # 将cookies写入到本地文件，供以后程序访问公众号时携带作为身份识别用
    with open('cookies.txt', "w") as file:
        #  写入转成字符串的字典
        file.write(json.dumps(cookie))
    driver.close()


    '''第二步：爬取公众号标题和地址'''
    url = 'https://mp.weixin.qq.com'
    # 读取上一步获取到的cookies
    with open('cookies.txt', 'r', encoding='utf-8') as f:
        cookie = f.read()
    cookies = json.loads(cookie)  # 变成字典
    response = requests.get(url=url, cookies=cookies)
    token = re.findall(r'token=(\d+)', str(response.url))[0]  # 因为在上文分析中得到需要token
    print(token)
    # 设置headers
    headers = {
            "HOST": "mp.weixin.qq.com",
            "Referer": "https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit_v2&action=edit&isNew=1&type=10&token=" + token + "&lang=zh_CN",
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36"
    }

    f=open("csv_document/灰灰考研公众号.csv",mode='a',encoding='utf-8',newline='')
    csv_writer=csv.DictWriter(f,fieldnames=['标题','文章地址'])
    csv_writer.writeheader()

    with open("csv_document/灰灰考研公众号.csv","w",encoding='utf-8') as file:
        for j in range(1,43):
            begin=(j-1)*5
            requestUrl="https://mp.weixin.qq.com/cgi-bin/appmsg?action=list_ex&begin="+str(begin)+"&count=5&fakeid=MzUyMzc3NzI2Nw==&type=9&query=%E8%B5%84%E6%96%99%E5%8C%85&token="+token+"&lang=zh_CN&f=json&ajax=1"
            search_response=requests.get(requestUrl,cookies=cookies,headers=headers)
            re_text=search_response.json()
            print(re_text)
            list=re_text.get("app_msg_list")
            for i in list:
                title = i["title"]
                link_url = i['link']
                dit = {
                    '标题': title,
                    '文章地址': link_url
                }
                csv_writer.writerow(dit)
                print(dit)
            time.sleep(20)

if __name__ == '__main__':
    if os.path.exists("csv_document"):
        pass
    else:
        os.mkdir("csv_document")
        pass
    function()


