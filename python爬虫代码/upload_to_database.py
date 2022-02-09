import csv
import pymysql

# 连接MySQL数据库（注意：charset参数是utf8而不是utf-8）
conn = pymysql.connect(host='localhost', user='root', password='1700130234', db='php', charset='utf8')

# 创建游标对象
cursor = conn.cursor()

# 读取csv文件
with open('file_into_database/网盘链接——提取码.csv', 'r', encoding='utf-8') as f:
    read = csv.reader(f)

    # 一行一行地存，除去第一行和第一列
    for each in list(read)[1:]:
        i = tuple(each[0:])
        # 使用SQL语句添加数据
        sql = "INSERT INTO wplink VALUES" + str(i)  # db_top100是表的名称
        cursor.execute(sql)  # 执行SQL语句

    conn.commit()  # 提交数据
    cursor.close()  # 关闭游标
    conn.close()  # 关闭数据库
