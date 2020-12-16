<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"
        name="viewport" />
    <meta content="webkit" name="renderer" />
    <meta content="True" name="HandheldFriendly" />
    <meta content="320" name="MobileOptimized" />
    <meta content="telephone=no" name="format-detection" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link href="/img/favicon.ico" rel="shortcut icon" />
    <title>
        绿点支付 - 个人收款接口服务专家
    </title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
</head>
<body>
    <header>
        <img src="/img/logo.png" />
        <h3>
            绿点支付
        </h3>
        <p class="text-muted">
            个人收款接口服务专家
        </p>
    </header>
    <main>
        <form class="content" method="post" action="/pay_handle">
            <div class="form-group">
                <label class="form-label">支付金额</label>
                <input class="form-control" name="amount" placeholder="支付金额" type="text" value="1.00">
                <span class="form-text text-muted">
                    单位：元。精确小数点后 2 位
                </span>
                </input>
            </div>
            <div class="form-group">
                <label class="form-label">支付方式</label>
                <select name="type" class="form-control">
                    <option value="1">支付宝</option>
                    <option value="2">微信</option>
                </select>
            </div>
            <div>
                <button class="btn btn-success btn-block">提交</button>
            </div>
        </form>
    </main>
    <footer>
        <p class="text-muted mb-1">
            详细接入文档，请查看
        </p>
        <a href="https://www.greenyep.com/doc/dev_pre.html" target="_blank">
            https://www.greenyep.com/doc/dev_pre.html
        </a>
    </footer>
</body>
</html>