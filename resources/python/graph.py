import pandas as pd
import sys, getopt
import json, csv


def main(argv):
   directory = ''
   data = ''
   method = ''
   experiment = ''

   try:
      opts, args = getopt.getopt(argv,"hd:c:m:e:")
   except getopt.GetoptError:
      print 'graph.py -d <directory> -c <csv> -m <method> -e=<experiment>'
      sys.exit(2)
   for opt, arg in opts:
      if opt == '-h':
         print 'test.py -directory <directory> -data <v> -segment <name> -exeriment=<experiment>'
         sys.exit()
      elif opt == "-d":
         directory = arg
      elif opt == "-c":
         data = arg
      elif opt == "-m":
         method = arg
      elif opt == "-e":
         experiment = arg

   patterns = get_patterns(directory+"/"+experiment+".json")
   df = pd.read_csv(directory+"/"+data+".csv")


   out_df = pd.DataFrame()
   if method == 'visits':
       out_df = visits(df, patterns)

   out_df.to_csv(path_or_buf = directory+"/"+experiment+"_" + method + ".csv", encoding='utf-8', quoting=csv.QUOTE_NONNUMERIC, index=False);



def visits(df, patterns):
    return pagesByTimePeriod(df, patterns)


def pagesByTimePeriod(df, patterns):

    weeks = df['week'].unique()
    df2 = pd.DataFrame({'week' : weeks}).sort_values(by = 'week', ascending=True)
    df2.set_index('week')

    result = df2
    #print df2


    for row in patterns:
        row_df = df2;
        num = 0;
        for pat in row['patterns']:
            print pat
            pages_df = df[
                df['enter page'].str.contains(pat)
            ].groupby('week')[['visit num']].sum()
            pages_df.fillna(value=0, axis=1)

            if num == 0:
                row_df = pd.merge(df2, pages_df, how='left', left_on='week', right_index=True)
                row_df.fillna(0, inplace=True)
                #print row_df
            else:
                row_df2 = pd.merge(df2, pages_df, how='left', left_on='week', right_index=True)
                row_df2.fillna(0, inplace=True)
                row_df['visit num'] = row_df['visit num'] + row_df2['visit num']
            num = num + 1

        row_df = row_df.rename(index=str, columns={'visit num': row['title']})
        print row_df
        result = pd.merge(result, row_df, how='left', on='week')

    return result





def get_patterns(jsonfile):
   with open(jsonfile) as json_file:
       data = json.load(json_file)
   return data['patterns'];




if __name__ == "__main__":
   main(sys.argv[1:])